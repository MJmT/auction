<form method="post" action="<?php echo "index.php?order_code=$order->order_code" ?>" name="payform">
<input type="hidden" value="<?php echo  $order->GetProductId()?>" name="product_id" />
<input type="submit" class="button medium alt icon fa-info-circle  name="paypal" value="Pay using Paypal" />