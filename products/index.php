<?php



require_once("classes/ProductDisplay.php");
require_once("classes/Auction.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/user/classes/User.php');

$product = new ProductDisplay();
$user = new User();
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

if (isset($auction)) {
    if ($auction->errors) {
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
Hello
<?php
echo $product->GetProductId();
echo $product->GetProductName();
echo $product->GetProductTitle();
echo $product->GetProductdescription();
echo $product->GetProductPrice();
echo $auction->user_bid;
if($auction->auction_status)
    if($auction->ValidUser()) 
        include('/views/bids.php');
if($auction->user_bid_status) {
    if($auction->user_highest_bidder)
        echo "Congrats. You are currently the highest bidder. Refresh the page to see updates!";
    else
        echo "Sorry ". $_SESSION['user_name']. "! Some outdid your bid of ". $auction->user_bid.".";
}

else echo "Get out";

echo $auction->GetCurrentHighestBid();

   
   


