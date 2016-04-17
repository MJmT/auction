<?php

 require_once("../config/db.php");
 require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/AbstractShopping.php');

 class Order extends AbstractShoppingClass {
	public function __construct(ProductDisplay $product) {
		AbstractShoppingClass::__construct($product);

		if(isset($_POST['buynow'])) {
			$this->BuyNow();
		}
	}
}