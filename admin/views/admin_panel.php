<!DOCTYPE html> 
<html>
	<head>
		<title> Admin Panel </title>
	</head>
	<body>
	<?php
	/** Create an array of admin features with the key being the get url
		* and the value being the feature 
		*/
		$tasks	= array('user_accounts'=> 'User account Management','products' => 'Product management','categories' => 'Category Management','static_pages'=>'Page creation and deletion', 'customer_query'=> 'Answer Queries from users');
 		
			echo '<ul>';
			foreach($tasks as $key => $val) {
						
				echo '<li><a href="'.$key.'">'.$val.'</a></li>';
					
				}
			echo '</ul>';
		
			?>
	</body>
</html>