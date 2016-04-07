<?php 
require_once("../config/db.php");

// load the login class
require_once("classes/User.php");

$user = new User();




	if($user->isUserLoggedIn() == false) {
		header("Location: ../index.php");
	}
	else if($user->isProfileComplete($_SESSION['user_name']) == true) {
			header("Location:index.php");
			exit();
		}
	else {
		include('views/profile_setup.php');
	}
	

		
