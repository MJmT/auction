<?php

if(isset($category)) {
	if($category->errors) {
		foreach( $category->errors as $error) 
			echo $error;
	}
}    
?>
<html>
<body>
<h1> <?php echo $category->GetCategoryTitle() ?> </h1>
<br>
<p> <?php echo $category->GetCategoryDescription() ?> </p>
<table style= "width:80%">
	<tr> 
		<td> Product Id </td>
		<td> Product Name </td>
		<td> Product Title </td>
		<td> Product Description </td>
		<td> Product Price </td>
		
		<?php $result= $category->GetProductList();
		 {
 		echo '<tr>';
 		echo '<td>'.$result['product_id'].'</td>';
 		echo '<td><a href=\'http://localhost/pro2/products/'. $result['product_id_hash'].'\'>'.$result['product_name'].'</a></td>';
 		echo '<td>'.$result['product_title'].'</td>';
 		echo '<td>'.$result['product_description'].'</td>';
 		echo '<td>'.$result['product_price'].'</td>';
 		
 		
 		}
?>	</tr>