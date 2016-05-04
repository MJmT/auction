<?php


 require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractShopping.php');


 class Order extends AbstractShoppingClass {
	public $order_status;
	public $order_code;
	private $order_details;
	private $product_details;
	private $address_details;
	public $show_payment_page;

	public $show_order_confirmation;
	protected $product_id;

	public function GetOrderDetails() {
		return $this->order_details;
	}
	public function GetProductDetails() {
		return $this->product_details;
	}

	public function GetAddressDetails() {
		return $this->address_details;
	}
		
	public function __construct() {
		 
		
		if (session_status() == PHP_SESSION_NONE) {
          session_start();
}

		if(isset($_POST['buynow'])) {
            $this->product_id = $_POST['product_id'];
            $this->BuyNow();
        }
      if(isset($_POST['paypal'])) {
            $this->product_id = $_POST['product_id'];
            $this->SetPaymentVerified();
        }
 		
 		if(isset($_POST['confirmnpay'])) {
 			$this->show_payment_page = true;
 		}

		if(isset($_GET['order_code']))
			$this->OrderPageDisplay();

	}

	 //you have to set order_status 1 when auction starts
		//2 when in auction ends
		//3 when buynow order succeeds;
		//4 when bid order succeeds;
		//Insert into orders table
	

	protected function PaymentVerified() {
    
  }
	protected function BuyNow() {

		if($this->OrderStatus()==0) {
			$this->order_status =3;
			$this->SetOrderStatusDb();
			if($this->SetOrderDb())
				$this->show_order_confirmation=true;
		}
	}

	 

	 protected function SetOrderDb() {
     		$this->order_id_hex= $this->GenerateUniqueHash();
     		
     	if($this->GetOrderStatusDb()==2) { 
     		$this->order_type = 0;
     		$this->order_price = $this->GetCurrentHighestBiddb();
     	}
     	elseif($this->GetOrderStatusDb()==3) {
     		$this->order_type =1;
     		$this->order_price = $this->GetProductMaxPricedb();
     	}
   

     	if($this->setupDbConnection() == true) {
     		$sql = "INSERT INTO orders(order_id_hex,user_name,product_id,order_type,price) VALUES('". $this->order_id_hex . "','" . $_SESSION['user_name'] . "','" . $this->GetProductId() . "','" . $this->order_type . "','" . $this->order_price."');"; 
     		$query_insert = $this->db_connection->query($sql);
     		if($query_insert) {
     			return true;

     		}

     		else{ 
     			$this->errors[] = "error," . $this->db_connection->error;

     		}


		}
    }

	
	protected function OrderPageDisplay() {

		$this->RetrieveOrderDetails();

	}	

	protected function RetrieveOrderDetails() {
		if($this->setupDbConnection()==true) { 
  			$this->ValidateRequest();
  			
  			$sql = "SELECT product_id FROM orders WHERE order_id_hex ='". $this->order_code ."';";
  			$query= $this->db_connection->query($sql);
  			if($query && $query->num_rows==1) {
  				$obj = $query->fetch_object();
  				$this->product_id= $obj->product_id;
  			}
  			else {
  				
  				header("Location:http://" . $_SERVER['SERVER_NAME'] . "/error.php");
  				exit();

  			}
  			if(isset($this->product_id)) {
  			$sql = "SELECT order_id, user_name,price, order_type From orders 
  					where product_id='" .$this->GetProductId() . "';";

  			$query_order = $this->db_connection->query($sql);
  			if($query_order) {

  				$this->order_details = $query_order;
  			}
  			$sql = "SELECT product_name, product_title,product_description,category_name From
  					products where product_id='". $this->GetProductId() . "';";
  			$query_product = $this->db_connection->query($sql);
  			if($query_product) {

  				$this->product_details = $query_product;
  			}

  			$sql = "SELECT * from address where user_name = '".$_SESSION['user_name'] . "';";

  			$query_address = $this->db_connection->query($sql);
  			if($query_address) {
  				$this->address_details = $query_address;
  			}
  			if(!isset($this->order_details) || !isset($this->product_details) )
  				$this->errors[]= "Heello" . $this->db_connection->error;
			}
		}
	}

	protected function ValidateRequest() {
			
			$this->order_code = $this->db_connection->real_escape_string(strip_tags($_GET['order_code'], ENT_QUOTES));
	}
} 
















		 	/*if($this->setupDbConnection()==true)  {
				$sql = "INSERT INTO orders(user_name,product_id) 
    				VALUES ('" . $_SESSION['user_name'] . "','" . $this->GetProductId() . "');";
    			$query_insert = $this->db_connection->query($sql);
    			if($query_insert) {
    				$this->order_status= 1;
    				$sql = "UPDATE products_metadata 
    					SET order_status='" . $this->order_status . "' 
    					WHERE product_id='". $this->GetProductId() . "';";
    				$query_update = $this->db_connection->query($sql);
    				if($query_update){
    						return true;
    				}
    			}
    			

    		}


	
	protected function GetProductStatus() {
		if($this->setupDbConnection()==true)  {
    		$sql =  "SELECT order_status from products_metadata where product_id='" . $this->GetProductId() . "';";
    		$query_check = $this->db_connection->query($sql);
    		if($query_check && $query_check->num_rows ==1) {
    			$obj = $query_check->fetch_object();
    			$this->order_status = $obj->order_status;
    		}
    		else{
    		 return false;
    		 $this->errors[]= "Get order failed";
    		}
		}
	}*/
