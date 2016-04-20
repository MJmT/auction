<?php



require_once("classes/ProductDisplay.php");
require_once("classes/Auction.php");

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/orders/classes/Order.php');

$product = new ProductDisplay();

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


    

echo "<h1>".$product->GetProductTitle()."</h1>";


echo "<p><font size= 5px>" . $product->GetProductdescription() . "</p></font>";
echo "<p>Bid Amount: ". $product->GetProductBidPrice() . "</p>";




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
            echo $message;
    }
    else if ($auction->errors) {
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
elseif($auction->order_status==0) { 
    $order = new Order($product);
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
   echo $order->order_status;
   echo $order->GetProductId();
    echo "Bididng will start soon! Can't Wait?  Buy this product at a higher price. ";
    echo "<p>Sale Price: " . $product->GetProductMaxPrice() . "</p>";
    include('/views/buynow.php');
}

elseif($auction->order_status ==2) {
    if( $auction->user_highest_bidder) {
        $order_code=$auction->GetOrderCode();
        echo $order_code;
      header("Location: http://localhost/orders/index.php?order_code=$order_code ");
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


   
   


