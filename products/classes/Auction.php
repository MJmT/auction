<?php
 require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractShopping.php');

class Auction Extends AbstractShoppingClass {
	public function __construct(ProductDisplay $product) {
		AbstractShoppingClass::__construct($product);
		$this->ProductPageDisplay();
		if(isset($_POST['bid'])) {
 			$this->MakeBid();
 		}


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
    		 		
    		 	if(!$this->GetAuctionStatus()) 
	    		 	$sql = "INSERT INTO auctions(product_id,current_highest_bid,previous_highest_bid,current_bid_user,previous_bid_user)
    			 		VALUES('" . $this->GetProductId() . "','". $this->GetCurrentHighestBid() . "','". $this->GetPreviousBid() . "','". $this->GetCurrentHighestUser() . "','". $this->GetPreviousUser(). "');";

    		 	else 
    		 		$sql = "UPDATE auctions
    		 				SET current_highest_bid='" . $this->GetCurrentHighestBid() . "', current_bid_user='". $this->GetCurrentHighestUser(). "', previous_highest_bid='". $this->GetPreviousBid() . "', previous_bid_user='". $this->GetPreviousUser(). "'
    		 				WHERE product_id='". $this->GetProductId() ."';";

    		 	$query_auctions = $this->db_connection->query($sql);
    		 	if($query_auctions) {
    		 		
    		 		if($this->InsertBidsDb())
    		 			$this->messages[] = "Success! You could bid again to improve your chances!";
    		 		//To update the bids table;
    		 	}
    		 	else 
    		$this->errors[] = "Update to auctions table failed. Error code:". $this->db_connection->error . ".";
    		 

    		}
    	}
    }




}