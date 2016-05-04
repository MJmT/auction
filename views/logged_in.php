<!-- if you need user information, just put them into the $_SESSION variable and output them here -->


<div class="alert alert-success">Hey, <?php echo $_SESSION['user_name']; ?>. Congrats! You are  now logged in.</div>

<?php 
require_once('user/classes/User.php');
 $user= new User();
//if(!($user->isProfileComplete($_SESSION['user_name']))) { 
	
echo '<div id="main-wrapper">
					<div class="wrapper style1">
						<div class="inner">

							<!-- Feature 1 -->
								<section class="container box feature1">
									<div class="row">
										<div class="12u">
											<header class="first major">';
	echo "Please set up your profile before continuing.";
 	echo "<a href='user/setup_profile'> Profile setup </a>";

//header('Location:http://localhost/pro2/product-category');
?>
<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<a href="index.php?logout">Logout</a>
