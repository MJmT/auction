<?php
	
	class ProductCreation {

		private $db_connection = null;

		private $product_image_name;
		private $product_image;
		private $product_name;
		private $product_title;
		private $product_description;
		private $product_price;


		public $errors = array();

		public $messages = array();


		public function __construct() {

				session_start();

				if(isset($_POST["create"])) {
						$this->product_name = $_POST['product_name'];
						$this->product_title = $_POST['product_title'];
						$this->product_description = $_POST['product_description'];
						$this->product_price = $_POST['product_price'];
						$image_path= pathinfo($_FILES['product_image']['name']);
						$this->product_image_name = $this->GenerateImageName() . '.' . $image_path['extension']; 
						$this->product_image = addslashes (file_get_contents($_FILES['product_image']['tmp_name']));
						$this->CreateNewProduct();
				}
		}
		
		#new product entries
		private function CreateNewProduct() {
				$valid_product = false;
				
			 	if(empty($this->product_name)) {
            		$this->errors[] = "Empty Product Name"; 
			}	else if(empty($this->product_title)) {
					$this->errors[] = "Empty Product title";
			}	else if(empty($this->product_description)) {
					$this->errors[] = "Empty Product description";
			}	else if(empty($this->product_price)) {
					$this->errors[] = "Empty Product price";
			}
				 else if (strlen($this->product_name) > 64 || strlen($this->product_name) < 2) {
            		$this->errors[] = "Product name cannot be shorter than 2 or longer than 64 characters";
         	}	else if (strlen($this->product_title) > 100 || strlen($this->product_title) < 10) {
            		$this->errors[] = "Product title cannot be shorter than 10 or longer than 100 characters";
        	}	else if (!preg_match('/^[0-9]+(\.[0-9][0-9]?)?$/i', $this->product_price)) { 
        			$this->errors[] = "Price has to be a float with atmost 2 numbers following the dot.";

        	}	/*else if(!preg_match('/^image\/p?jpeg$/i', $_FILES['product_image']['type']) OR  
				!preg_match('/^image\/gif$/i', $_FILES['product_image']['type']) OR
				!preg_match('/^image\/(x-)?png$/i', $_FILES['product_image']['type'])) {
        			$this->errors[] = "Invalid File type. PNG/JPG/GIF are only supported.";*/
         	}
        		elseif (!empty($this->product_name)
        		&& strlen($this->product_name) <= 64
            	&& strlen($this->product_name) >= 2
            	//&& preg_match('/^[a-zA-Z\d]{2.64}$/i',($_POST['product_name'])) 
            	&& !empty($this->product_title)
        		&& strlen($this->product_title) <= 100
            	&& strlen($this->product_title) >= 10
            	&& !empty($this->product_price)
            	&& preg_match('/^[0-9]+(\.[0-9][0-9]?)?$/i', $this->product_price)) 
        		{
        			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        			if (!$this->db_connection->set_charset("utf8")) {
              		  $this->errors[] = $this->db_connection->error;
        	}
        			// if no connection errors (= working database connection)
       			    if (!$this->db_connection->connect_errno) {
       			    	$product_name = $this->db_connection->real_escape_string(strip_tags($this->product_name, ENT_QUOTES));
       			    	$product_title = $this->db_connection->real_escape_string(strip_tags($this->product_title, ENT_QUOTES));
       			    	$product_description=$this->db_connection->real_escape_string(strip_tags($this->product_description, ENT_QUOTES));
       			    	$product_price = $this->product_price;
       			    	$unique_id = $this->GenerateUniqueHash();

       			    	$sql = "INSERT INTO products (product_name,product_title,product_description,product_price,product_id_hash) 
       			    			VALUES('" . $product_name . "', '" . $product_title . "', '" . $product_description . "', '". $product_price . "', '" . $unique_id. "');";
       			    	$query_new_product_insert = $this->db_connection->query($sql);

       			    		if($query_new_product_insert) {
       			    				$valid_product = true;
       			    				$id = $this->db_connection->insert_id;
       			    				if($this->ImageHandle($id))  {
	       			    				$this->messages[] = "Your product has been successfully inserted";
       			    				}
	       			    			else {
	       			    				$this->errors[] = "Image uplaod failed";
	       			    			}
       			    		}
       			    		else {
       			    				$this->errors[] = "THe product insertion has failed. Please try again";
       			    		}
       			    }
       			    else {
       			    		$this->errors[] = "The database connection has not been set.";

       			    }
       			}
       			else {
       					$this->errors[] = "An unknown error has occured." ;

       			}
       			
				       			   
       			}
       		

       		private function GenerateUniqueHash() {
       				$unique_id =md5(uniqid(rand(),TRUE));
       				return $unique_id;
       		}
      	
      	 	private function GenerateImageName() {
       				$unique_id1 = uniqid(rand());
       				$unique_id2 = uniqid(rand());
       				return $unique_id1 . '_' . $unique_id2;
       		}

    	   	private function ImageHandle($product_id) {
       		 if (!$this->db_connection->connect_errno) {
       		 	
       			$sql="INSERT INTO product_images(product_id,product_image_name,product_image)
       			 VALUES('" . $product_id . "', '" . $this->product_image_name . "', '" . $this->product_image . "');";
       			$query_new_image_insert = $this->db_connection->query($sql);
       			}
       			 $this->errors[] = $this->db_connection->error; 

       			if($query_new_image_insert) {
       				   
       					return true;
       				}
       				else
       					return false;
       		}
       	}
     