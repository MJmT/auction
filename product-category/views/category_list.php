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
<table style= "width:80%">
	<tr> 
		<td> Category id </td>
		<td> Category Name </td>
		<td> Category Description </td>

		<?php $result_from_query= $category->GetCategoryList();
		  while ($result= $result_from_query->fetch_assoc())  {
 		echo '<tr>';
 		echo '<td>'.$result['category_id'].'</td>';
 		echo '<td><a href=\'http://localhost/pro2/product-category/'. $result['category_name'].'\'>'. $result['category_title'] . '</a></td>';
 		echo '<td>'. $result['category_description'] . '</td>';
 	}
 	?>
 	</tr>