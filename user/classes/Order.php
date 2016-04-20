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

		if(isset($_GET['order_code']))
			$this->OrderPageDisplay();

	}

	 //you have to set order_status 1 when auction starts
		//2 when in auction ends
		//3 when buynow order succeeds;
		//4 when bid order succeeds;
		//Insert into orders table
	
	protected function BuyNow() {

		if($this->OrderStatus()==0) {
			$this->order_status =3;
			$this->SetOrderStatusDb();
			$this->SetOrderDb();
		}
	}
	
	protected function OrderPageDisplay() {
		$this->RetrieveOrderDetails();

	}	

	protected function RetrieveOrderDetails() {
		if($this->setupDbConnection()==true) { 
  			$this->ValidateRequest();
  			$sql = "SELECT orders.order_id, orders.user_name,orders.price,orders.order_type, address.* ,products.product_name,products.product_title,products.product_description,products.category_name
  				FROM orders inner join products on orders.product_id=products.product_id
  				inner join address on orders.user_name=address.user_name
  				Where product_id='". $this->GetProductId() . '"'
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
