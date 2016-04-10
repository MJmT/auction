<?php

class ProductCategory {
	private $db_connection = NULL;
	public $errors = array();
	public $messages = array();
  	public $category_name;
  	private $category_title;
  	private $category_description;
  	private $category_parent_id;


	public function __construct() {
		session_start();
		//If there exists a get request of the form category=coinscurrency
		if(isset($_GET['category'])) {
			$this->DisplayCategoryPage();
		}
	}
	public function GetCategoryTitle() {
		return $this->category_title;
	}
	public function GetCategoryDescription() {
		return $this->category_description;
	}
	public function GetCategoryParentId() {
		$return $this->category_parent_id;
	} 

	private function DisplayCategoryPage() {
			$this->ValidateRequest();
			if($this->setupDbConnection()==true) {
				$sql = "SELECT * from CATEGORIES where category_name= '".$this->category ."';"; 
				$return_category = $this->db_connection->query($sql);
				if($return_category and $return_category->num_rows==1) {
					$category_object = $return_category->fetch_object();
					$this->category_title = $category_object->category_title;
					$this->category_description = $category_object->category_description;
					$this->category_parent_id = $category_object->parent_id;
					$this->GetProducts();
					}
				else {
					$this->errors[] = "The requested page doesn't exist.";
					include('views/errors/404.php');
					exit();
					}
			
			}


	}
	//Escape the quotes to prevent injection
	private function ValidateRequest() {
		$this->category_name = $this->db_connection->real_escape_string(strip_tags($_GET['category'], ENT_QUOTES));
	}

	private function setupDbConnection() {


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
}