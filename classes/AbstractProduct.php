<?php

class AbstractProductClass {
	protected $db_connection = NULL;
    public $errors = array();
    public $messages = array();
	/* product data use POST with ProductCreation and GET with ProductDisplay*/
    protected $product_image_name;
	protected $product_image;
	public $product_id;
	protected $product_name;
	protected $product_title;
	protected $product_description;
	protected $product_price;

	//Setter method, sets $this->attribute = $datavalue obtained from database;


	//Getter methods for each attribute
	public function GetProductName() {
		return $this->product_name;
	}	

	
	public function GetProductTitle() {
		return $this->product_title;
	}

	
	public function GetProductDescription() {
		return $this->product_description;
	}


	public function GetProductPrice() {
		return $this->product_price;
	}

	
	public function GetProductImageName() {
		return $this->product_image_name;
	}

	public function GetProductImage() {
		return $this->product_image;
	}

	public function GetProductId() {
		return $this->product_id;
	}

  	public function __construct() {
  		session_start() ;
  	}

 	//Retrieve the product details from the database 
  	protected function RetrieveProductdb() {

  		if($this->setupDbConnection()==true)
       { $sql = "SELECT products.*, product_images.product_image_name, product_images.product_image FROM products inner join product_images WHERE products.product_id_hash= '". $_GET['product_code'] . "' AND products.product_id= product_images.product_id;";
   		$return_product_data= $this->db_connection->query($sql);
   		if($return_product_data && $return_product_data->num_rows ==1 ) {

  			$obj_result = $return_product_data->fetch_object();
  			$this->product_id = $obj_result->product_id;
  			$this->product_name = $obj_result->product_name;
  			$this->product_title = $obj_result->product_title;
  			$this->product_description= $obj_result->product_description;
  			$this->product_image_name = $obj_result->product_image_name;
  			$this->product_image = $obj_result->product_image;

   			}
   			else 
   				$this->errors[] = "The requested product doesn't exist!";


		}
			else {
				$this->errors[] = "The database connection failed.";
			}
		}
	protected function setupDbConnection() {

    // create a database connection, using the constants from config/db.php (which we loaded in index.php)
    $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


            // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
           }

          // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno)
        	return true;
        else
        	return false;
    }
}