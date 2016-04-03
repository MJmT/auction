<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Admin.php");

	#Create a new admin instance
	$admin = new Admin();
	#If the current session doesn't have the administrator privilge(100), then redirect to the error page
	if($_SESSION["user_privilege"]!=100) {
		header("Location: error.php");
		exit;
	}

	if($admin->clickAction("") == "home") {

	include('views/admin_panel.php');
	}
	#f(strcmp($admin->clickAction(),"user_accounts")) {
	else if ($admin->clickAction("user_accounts") == "user_accounts")
			include('views/user_accounts.php');
	
	