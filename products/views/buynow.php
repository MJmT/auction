<form method="post" action="<?php echo $product->product_code ?>" name="buyform">
<input type="hidden" value="<?php echo  $product->GetProductId()?>" name="product_id" />
<input type="submit"  name="buynow" value="Buy Now!" />