<?php

require_once("../config/db.php");

require_once("classes/ProductDisplay.php");

$product = new ProductDisplay();
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
echo $product->GetProductImage();