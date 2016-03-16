<!DOCTYPE html> 
<html>
	<head>
		<title> Admin's Area </title>
	</head
	<body>
	asd
		<?php 	echo $_SESSION['user_name'];

			if(strcmp($_SESSION['user_name'],'admin')!=0) 
				echo "This is a restricted access page.";
			else
				echo "Welcome to Admin club";
		?>
	</body>
</html>