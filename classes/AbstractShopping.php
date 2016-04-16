<?php

	require_once("../config/db.php");
 require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractProduct.php');
 
 class AbstractShoppingclass extends AbstractProductClass {
	//bid,auction variables 
 	protected $auction_start;
 	protected $auction_end;
 	protected $current_bid;
 	protected $previous_bid;
 	protected $current_user;
 	protected $previous_user;
 	
 	//flags
 	public $auction_status;
 	public $user_status;
 	public $user_bid;
 	public $user_highest_bidder;

 	

 	public function GetAuctionStart() {
 		return $this->auction_start;
 	}

 	public function GetAuctionEnd() {
 		return $this->auction_end;
 	}

 	public function GetCurrentHighestUser() {
 		return $this->current_user;
 	}
 	public function GetCurrentHighestBid() {
 		return $this->current_bid;

 	}


 	public function GetPreviousBid() {
 		return $this->previous_bid;
 	}

 	public function GetPreviousUser() {
 		return $this->previous_user;
 	}

 	public function __construct(ProductDisplay $product) {

 		date_default_timezone_set('Asia/Kolkata');
 		$this->product_id = $product->product_id;
 		$this->product_price = $product->product_price;
 		
 		$this->ProductPageDisplay();

 		if(isset($_POST['bid'])) {
 			$this->MakeBid();

 		}
 	}
 	public function ValidUser() {
 		//Inject the User class and its funcions into this class
 		if($_SESSION['user_login_status']==1)
 			return true;
 
 	}	
 	

    private function MakeBid() {
    		if(!$this->GetAuctionStatusDb()) { 
    			
    			$this->InitAuctionMembers();
    		}

    	//validate each aspect, ie the bid amount is valid, the user is logged in, and whether the auction time is valid
    	if($this->ValidBid() && $this->ValidUser() && $this->validAuction()) {
    		//If everything is good, then set the auction members to new values
    		 $this->previous_bid = $this->current_bid;
    		 $this->previous_user = $this->current_user;
    		 $this->current_bid = $_POST['bid_amount'];
    		 $this->current_user = $_SESSION['user_name'];
    		 if($this->setupDbConnection()==true)  {
    		 	//The case where the auction record is yet to be created
    		 		
    		 	if(!$this->auction_status) 
	    		 	$sql = "INSERT INTO auctions(product_id,current_highest_bid,previous_highest_bid,current_bid_user,previous_bid_user)
    			 		VALUES('" . $this->GetProductId() . "','". $this->GetCurrentHighestBid() . "','". $this->GetPreviousBid() . "','". $this->GetCurrentHighestUser() . "','". $this->GetPreviousUser(). "');";

    		 	else 
    		 		$sql = "UPDATE auctions
    		 				SET current_highest_bid='" . $this->GetCurrentHighestBid() . "', current_bid_user='". $this->GetCurrentHighestUser(). "', previous_highest_bid='". $this->GetPreviousBid() . "', previous_bid_user='". $this->GetPreviousUser(). "'
    		 				WHERE product_id='". $this->GetProductId() ."';";

    		 	$query_auctions = $this->db_connection->query($sql);
    		 	if($query_auctions) {
    		 		$auction_not_started = false;
    		 		if($this->InsertBidsDb())
    		 			$this->messages[] = "Success! You could bid again to improve your chances!";
    		 		//To update the bids table;
    		 	}
    		 	else 
    		$this->errors[] = "Update to auctions table failed. Error code:". $this->db_connection->error . ".";
    		 

    		}
    	}
    }

    private function  InsertBidsDb() {
    	$sql = "INSERT INTO bids(user_name,product_id,bid_amount) 
    			VALUES ('" . $_SESSION['user_name'] . "','" .$this->GetProductId() . "','" . $this->GetCurrentHighestBid() . "');";
    	$query_insert_bid = $this->db_connection->query($sql);
    	if($query_insert_bid)
    		return true;
    	else 
    		$this->errors[] = "Insert to bids table failed. Error code:". $this->db_connection->error . ".";
    }


    

    private function InitAuctionMembers() {
    	$this->current_bid = $this->GetProductPrice();
    		$this->previous_bid = 0;
    		$this->current_user = null;
    		$this->previous_user = null;
    }

	private function CheckBidAmount() {
		if($_POST['bid_amount']<$this->GetCurrentHighestBid())
			$this->messages[] = "You can't down bid. Your bid amount is lower than the current highest bid.Try again";
		elseif($_POST['bid_amount']==$this->GetCurrentHighestBid())
			$this->messages[] = "You are close!! Your current bid matches the current highest bid. Try again with a bigger bid.";
		/*
		A bit of work to be done in bit range. Just a prototype below 
		with bid increments being limited to 100.

		*/ 
		elseif($this->GetCurrentHighestBid() - $_POST['bid_amount']>100)
			$this->messages[] = "Sorry. Bid increments cannot exceed 100 at this moment. You can purchase the product at the maximum retail price instead.";
	else 
		return true;
	}
    

    private function ValidBid() {
    	if(empty($_POST['bid_amount'])) 
			$this->errors[] = "You cannot leave an empty bid";
		else if (!preg_match('/^[0-9]{2,10}$/i', $_POST['bid_amount']))  
        			$this->errors[] = "Amount has to be an integer value.";
        else if(!$this->CheckBidAmount())
        	return false;
        else return true;
    }

    protected function ValidAuction() {
    	 if($this->setupDbConnection()==true)  {

    	 	$sql = "SELECT product_auction_start,product_auction_end from products_metadata where product_id='" . $this->GetProductId() . "';";

    	 	$query_check = $this->db_connection->query($sql);

    	 	if($query_check && $query_check->num_rows ==1) {
    	 		$obj = $query_check->fetch_object();
    	 		$this->auction_start = $obj->product_auction_start;
    	 		$this->auction_end = $obj->product_auction_end;
    	 		
    	 		if($this->CheckDateRange()==true) 
    	 			return true;
    	 		else return false;
    	 	}
    	 	else {
    	 		$this->errors[] = "The auction time was not set for this product!";
    	 	}

   		}
    }
    private function ProductPageDisplay() {
    	if($this->hasAuctionStarted()) {
    		$this->auction_status = true;
    		if(!$this->GetAuctionStatusDb())
    			$this->InitAuctionMembers();
    		else
    			if($this->HasUserAlreadybid()) {
    				$this->user_bid_status = true;
    				if($this->isUserHighestBidder())
    					$this->user_highest_bidder = true;

    			}


    	}
    	else {
    		$this->auction_status = false;
    		$this->InitAuctionMembers();
    	}
    }

    private function hasUseralreadybid() {
    	if($this->setupDbConnection()==true)  {

    	 	$sql = "SELECT * from bids where user_name='" . $_SESSION['user_name'] . "' ORDER BY bid_amount desc limit 1;";


    	 	$query_check = $this->db_connection->query($sql);

    	 	if($query_check && $query_check->num_rows ==1) {
    	 		$obj = $query_check->fetch_object();
    	 		$this->user_bid = $obj->bid_amount;
    	 		return true;
   		 	}
    		else false;
   		}
	}

	private function isUserHighestBidder() {
		 if($this->setupDbConnection()==true)  {	
			$sql = "SELECT current_bid_user from auctions where product_id='" . $this->GetProductId(). "';";

    	 	$query_check = $this->db_connection->query($sql);

    	 	if($query_check && $query_check->num_rows ==1) {
    	 		$obj = $query_check->fetch_object();
    	 		if(strcmp($_SESSION['user_name'], $obj->current_bid_user)==0)
    	 			return true;
    	 	}
    	}
	}

    public function hasAuctionStarted() {
    	 if($this->setupDbConnection()==true)  {

    	 	$sql = "SELECT product_auction_start,product_auction_end from products_metadata where product_id='" . $this->GetProductId() . "';";

    	 	$query_check = $this->db_connection->query($sql);

    	 	if($query_check && $query_check->num_rows ==1) {
    	 		$obj = $query_check->fetch_object();
    	 		$this->auction_start = $obj->product_auction_start;
    	 		$this->auction_end = $obj->product_auction_end;
    	 		$start = strtotime($this->auction_start);
    			$end  = strtotime($this->auction_end);
    	 		$current_time =strtotime(date('Y-m-d H:i:s'));
    	 		if($current_time>$start && $current_time<$end)
    	 			return true;
    	 	}

   		}
   	}


    protected function CheckDateRange() {
    	$start = strtotime($this->auction_start);
    	$end  = strtotime($this->auction_end);
    	$current_time =strtotime(date('Y-m-d H:i:s'));
    	if($current_time<$start)
    		$this->messages[]= "The auction is set to begin at " . date('H:i:s',$start) . " on ". date('D')."day, " . date('d, M, Y',$start) . ". You are a bit early.";
    	else if($current_time>$end) 
    		$this->messages[]= "Oops. Time is up.!!";
    	else
    		return true;
    	
    }

    private function GetAuctionStatusDb() {
        if($this->setupDbConnection()==true)  {
    		$sql =  "SELECT * from auctions where product_id='" . $this->GetProductId() . "';";
    		$query_check = $this->db_connection->query($sql);

    		if($query_check && $query_check->num_rows ==1) {
    	 		$obj = $query_check->fetch_object();
    		 	$this->current_bid = $obj->current_highest_bid;
    		 	$this->current_user = $obj->current_bid_user;
    	 		$this->previous_bid = $obj->previous_highest_bid;
    		 	$this->previous_user = $obj->previous_bid_user;
    		 	return true;
    		}

 			else 
 				return false;
 		}
 	}
 }