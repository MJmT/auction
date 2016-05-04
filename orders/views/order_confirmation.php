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
    include_once('order_template.php');
$row = $product_details->fetch_assoc();

echo "<h2> Order Details </h2>";
echo "<h3> $row[product_title] </h3><p> $row[product_description] </p> <br>";
echo '</header></div> 
<div class="6u 12u(mobile)">

<section class="sectionup">
 <header class="major">';

$row = $address_details->fetch_assoc();
echo "<h3> Address </h3>";
echo "<p> $row[Address1] </p><p> $row[Address2] </p> <p> $row[Address3] </p><p> $row[City] </p><p> $row[State] </p><p> $row[Country] </p>";
                                          
echo '</header></section></div>';
echo ' 
<div class="6u ">
<section class="sectionleft">
 <header class="major">';
 $row = $order_details->fetch_assoc();
 echo "<h3> Order id: " . $row['order_id']. "</h3>";
 echo "<h3> Order price: " . $row['price']. "</h3>";
 if($row['order_type'] ==0) 
    echo "<h3> Order Type: Auction</h3>";
else
    echo "<h3> Order Type: Direct Purchase</h3>";

 echo '</header></section></div></div>';
 echo '<div class="6u sectioncenter">

<section>';
include('confirmnpay.php');
}