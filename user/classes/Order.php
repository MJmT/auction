<?php

 require_once("../config/db.php");
 require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractShopping.php');

 class Order extends AbstractShoppingClass {
	public $order_status;

	public function __construct(ProductDisplay $product) {
		AbstractShoppingClass::__construct($product);

		if(isset($_POST['buynow'])) {
			$this->BuyNow();
		}


	}
	protected function BuyNow() {

		if(!$this->GetProductStatus() && $this->order_status == 0) {
			 //you have to set order_status 1 when auction starts
		//2 when in auction ends
		//3 when buynow order succeeds;
		//4 when bid order succeeds;
		//Insert into orders table
		 	if($this->setupDbConnection()==true)  {
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
	}
}