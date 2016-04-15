<?php

require_once("../config/db.php");

require_once("classes/ProductDisplay.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/user/classes/User.php');

$product = new ProductDisplay();
$user = new User();
if (isset($product)) {
    if ($product->errors) {
        foreach ($product->errors as $error) {
            echo $error;
        }
    }
    if ($product->messages) {
        foreach ($product->messages as $message) {
            echo $message;
        }
    }
}
?>
Hello
<?php
echo $product->GetProductId();
echo $product->GetProductName();
echo $product->GetProductTitle();
echo $product->GetProductdescription();
echo $product->GetProductImageName();


include('/views/bids.php');