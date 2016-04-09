<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractProduct.php');

class ProductDisplay extends AbstractProductClass {

	public function __construct() {
		AbstractProductClass::__construct();

		if(isset($_GET['product_code'])) {
			$this->RetrieveProductdb();
		}
	}

}