<?php 

$order_details= $order->GetOrderDetails();
$product_details = $order->GetProductDetails();
$address_details = $order->GetAddressDetails();

 if ($order->errors) {
        foreach ($order->errors as $error) {
            echo $error;
        }
    }
    if ($order->messages) {
        foreach ($order->messages as $message) {
            echo $message;
        }
    }
   echo $order->GetProductId();
  
  if(isset($product_details)) {
$row = $product_details->fetch_assoc();

echo "<h1> Order Details </h1>";
echo "<h3> $row[product_title] </h3><p> $row[product_description] </p> <br>";


include('confirmnpay.php');
}