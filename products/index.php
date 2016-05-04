<?php



require_once("classes/ProductDisplay.php");
require_once("classes/Auction.php");

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/orders/classes/Order.php');

$product = new ProductDisplay();
 include_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/layout/layout_header.php');


$product_image = $product->GetProductImage();
$product_image_name =  $product->GetProductImageName();

$auction = new Auction($product);
/*if (isset($product)) {
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
}*/

/*    if ($auction->errors) {
        foreach ($auction->errors as $error) {
            echo $error;
        }
    }
    if ($auction->messages) {
        foreach ($auction->messages as $message) {
            echo $message;
        }
    }
}
?>
*/


    
include_once('views/product_template.php');

echo "<h2>".$product->GetProductTitle()."</h2>";


echo "<p>" . $product->GetProductdescription() . "</p>";
echo '</header></div></div>';
echo '<div class="row">
        <div class="6u 12u(mobile)">
        <section>';

echo '<div class="proimg"><img   src="data:image/png;base64,' . base64_encode($product_image) . '" /></div></section></div>';
echo '<div class="6u"><section class="sectionleft"> <header class="major">';
echo "<h2>Bid Amount: ". $product->GetProductBidPrice() . "</h2>";






if($auction->order_status==1){

     echo "Current Highest Bid: " . $auction->GetCurrentHighestBid();
     
    if($auction->user_bid_status == 0)
        $auction->messages[]= "<p> You've not made any bids.! Start Bidding!!</p>";
       
    elseif($auction->user_bid_status == 1 && !$auction->user_highest_bidder ) {
        
      $auction->auction_message[]=  "<p> You've been outbid.! Bid bigger.";
    }
    elseif($auction->user_bid_status ==1 && $auction->user_highest_bidder) {

        $auction->auction_message[]=  "You are at the top! Refresh the page for updates.";
    }
  include('/views/bids.php');
 
   
 if ((empty($auction->errors)) && (empty($auction->messages))) {
        foreach ($auction->auction_message as $message)
            echo "<div class=\"alert alert-information\">" .$message . "</div>";
    }
    else if ($auction->errors) {
        foreach ($auction->errors as $error) {
            echo "<div class=\"alert alert-danger\">" .$error . "</div>";
        }
    }
    if ($auction->messages) {
        foreach ($auction->messages as $message) {
           echo "<div class=\"alert alert-warning\">" .$message . "</div>";
        }
    }

}
elseif($auction->order_status==0) { 
   $order= new Order();
    if ($order->errors) {
        foreach ($order->errors as $error) {
            echo "<div class=\"alert alert-danger\">" .$error . "</div>";
        }
    }
    if ($order->messages) {
        foreach ($order->messages as $message) {
            echo "<div class=\"alert alert-warning\">" .$message . "</div>";
        }
    }
   
   
    echo "<p>Bididng will start soon! Can't Wait?  Buy this product at a higher price. </P>";
    echo "<h3>Sale Price: " . $auction->GetProductMaxPrice() . "</h3>";
    include('/views/buynow.php');
    if(isset($order->show_order_confirmation) && $order->show_order_confirmation ==true) {
         $order_code=$order->GetOrderCode($product->GetProductId());
        header("Location: http://localhost/pro2/orders/index.php?order_code=$order_code "); 
    }
}



elseif($auction->order_status ==2) {
    if( $auction->user_highest_bidder) {
        $order_code=$order->GetOrderCode($product->GetProductId());
       
      header("Location: http://localhost/pro2/orders/index.php?order_code=$order_code ");
        exit();
    }
    else
        echo "You just lost this auction!";
}
    /*
}
if($auction->user_bid_status) {
    if($auction->user_highest_bidder)
        echo "Congrats. You are currently the highest bidder. Refresh the page to see updates!";
    else
        echo "Sorry ". $_SESSION['user_name']. "! Some outdid your bid of ". $auction->user_bid.".";
}

echo "Welcome. make your bid";
*/


   
   


