<!-- if you need user information, just put them into the $_SESSION variable and output them here -->


Hey, <?php echo $_SESSION['user_name']; ?>. Congrats! You are  now logged in.

<?php 
if($user->profile_complete == false) { 
	

	echo "Please set up your profile before continuing.";
 	echo "<a href='user/setup_profile'> Profile setup </a>";
}
?>
<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<a href="index.php?logout">Logout</a>
