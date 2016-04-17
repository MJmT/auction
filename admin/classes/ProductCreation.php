<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractProduct.php');
	class ProductCreation extends AbstractProductClass {


		public function __construct() {

				AbstractProductClass::__construct();

				if(isset($_POST["create"])) {
						$this->product_name = $_POST['product_name'];
						$this->product_title = $_POST['product_title'];
						$this->product_description = $_POST['product_description'];
						$this->product_bid_price = $_POST['product_bid_price'];
            $this->product_max_price = $_POST['product_max_price'];
            $this->product_category = $_POST['product_category'];
						$image_path= pathinfo($_FILES['product_image']['name']);
						$this->product_image_name = $this->GenerateImageName() . '.' . $image_path['extension']; 
						$this->product_image = addslashes (file_get_contents($_FILES['product_image']['tmp_name']));
						$this->CreateNewProduct();
				}
		}
		
		#new product entries
		private function CreateNewProduct() {
				$valid_product = false;
				
        if($this->ProductNameCheck() && $this->ProductTitleCheck() && $this-> ProductDescriptionCheck() && $this->ProductImageCheck() && $this->ProductPriceCheck()  && $this->ProductCategoryCheck()) {
			    
            if($this->SetupDbConnection() == true) {
			   
         		    	$product_name = $this->db_connection->real_escape_string(strip_tags($this->product_name, ENT_QUOTES));
       			    	$product_title = $this->db_connection->real_escape_string(strip_tags($this->product_title, ENT_QUOTES));
       			    	$product_description=$this->db_connection->real_escape_string(strip_tags($this->product_description, ENT_QUOTES));
       			    	$product_bid_price = (int) $this->product_bid_price;
                  $product_max_price = (int) $this->product_max_price;
       			    	$unique_id = $this->GenerateUniqueHash();
                  $product_category = $this->product_category;

       			    	$sql = "INSERT INTO products (product_name,product_title,product_description,product_bid_price,product_max_price, category_name, product_id_hash) 
       			    			VALUES('" . $product_name . "', '" . $product_title . "', '" . $product_description . "', '". $product_bid_price . "', '". $product_max_price . "','" . $product_category ."','" . $unique_id. "');";
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
       			    		else 
       			    				$this->errors[] = $this->db_connection->error;
       			    		
       			    }
       			    else 
       			    		$this->errors[] = "The database connection has not been set.";

       			    
       			}
       			else {
                if(empty($this->errors)) 
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
     