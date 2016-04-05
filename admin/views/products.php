<h1> Product Catalog </h1>
<h2> Create a new product entry </h2>
<?php 
	if(isset($product)) {
		if($product->errors) {
				foreach($product->errors as $error) {
					echo $error;
				}
		}

	
		if($product->messages) {
				foreach($product->messages as $message) {
						echo $message;
				}
		}
	}
?>
<!-- register form -->
<form method="post" action="product.php" enctype="multipart/form-data" name="productform">

 <label for="product_name">Product Name</label>
 <br>
    <input id="product_name" class="product_input" type="text" pattern="[a-zA-Z0-9_]{2,64}" name="product_name" required />
    <!-- Remove this br when styleing -->
<br><br>
     <label for="product_title">Product Title</label>
     <br>
    <input id="product_title" class="product_input" type="text" pattern="[a-zA-Z0-9 ]{10,50}" name="product_title" style="width:300px" required />
    <br><br>
     <label for="product_description">Product Description</label>
     <br>
 	<textarea id="product_description" rows="4" cols="50" name="product_description"> fg</textarea>
 	<br><br>
 	 <label for="product_price">Product Price</label>
 	 <br>
 	  <input id="product_price" class="product_input" type="text"  name="product_price" required />
 	  <br>
 	  <input type="file" name="product_image">
	 	
 	   <input type="submit"  name="create" value="Create" />
</form>