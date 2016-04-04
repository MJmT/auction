<?php
	
	class ProductCreation {

		private $db_connection = null;

		public $errors = array();

		public $messages = array();


		public function __construct() {

				session_start();

				if(isset($_POST["create"])) {
						$this->CreateNewProduct();
				}
		}
		
		#new product entries
		public function CreateNewProduct() {

			emptyAttribute("product_name");
			emptyAtrribute("product_title");
			emptyAttribute("product_description");
			emptyAttribute("product_specification");

		}
		#determines whether an attribute is empty
		public function emptyAttribute($attribute) {
				if(empty($_POST[$attribute]) {
						$this -> errors[] = "Empty $attribute field";
						}

		}

		#determines whether an attribute is not less than desired length

		public function fixedsizeAttribute($attribute, $size) {
				if(strlen($_POST[$attribute])<$size) {
						$this -> errors[] = "$attribute field is not of sufficent length($size)";
				}
			}
		}

