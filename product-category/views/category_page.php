<?php

if(isset($category)) {
	if($category->errors) {
		foreach( $category->errors as $error) 
			echo $error;
	}
}    
?>

<h2> <?php echo $category->GetCategoryTitle() ?> </h2>
<br>
<p> <?php echo $category->GetCategoryDescription() ?> </p>
</header>
</div>

	<div class ="imgside">	
		<?php $result_from_query= $category->GetProductList();
			$count=0;
		  while ($result= $result_from_query->fetch_assoc())  {

		 if($count==3) {
		 	 echo '<div id="clearfloat" class ="imgside">';
 		}
 			echo '<div class="img">';
 		
 		echo '<a href=\'http://localhost/pro2/products/'. $result['product_id_hash'].'\'>';

  echo '<img src="data:image/png;base64,' . base64_encode($result['product_image']) . '" width="200" height="200" />';
  
  echo '</a><div class="desc">'. $result['product_title'] . ' </div></div>';
  
  		$count=$count+1;
 		
 		
 		}
?>	