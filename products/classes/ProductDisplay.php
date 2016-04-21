<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractProduct.php');

class ProductDisplay extends AbstractProductClass {

	public function __construct() {
		AbstractProductClass::__construct();

		if(isset($_GET['product_code'])) {
			$this->RetrieveProductdb();
		}
		
	}
	public function GetProductIddB() {
		if($this->setupDbConnection()) {
				$sql = "SELECT product_id FROM products 
				WHERE product_id_hash='". $_GET['product_code'] ."' ;";
				$query = $this->db_connection->query($sql);
				if($query && $query->num_rows==1) {
					$obj = $query->fetch_object();
					return $obj->product_id;
				}
		}
	}

}