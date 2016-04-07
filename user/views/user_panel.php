<!DOCTYPE html> 
<html>
	<head>
		<title> Account Settings </title>
	</head>
	<body>
	<?php
	/** Create an array of user features with the key being the get url
		* and the value being the feature 
		*/

		$tasks	= array('setup_profile' => 'Complete your account data', 'profile'=> 'View profile','profile/edit' => 'Edit your profile','orders' => 'My orders','addressbook'=>'Address Book');
 		
			echo '<ul>';
			foreach($tasks as $key => $val) {
						
				echo '<li><a href="'.$key.'">'.$val.'</a></li>';
					
				}
			echo '</ul>';
		
			?>
	</body>
</html>