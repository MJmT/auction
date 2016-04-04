<?php
// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Admin.php");

	#Create a new admin instance
	$admin = new Admin();
	#If the current session doesn't have the administrator privilge(100), then redirect to the error page
	if($_SESSION["user_privilege"]!=100) {
		header("Location: ../error.php");
		exit;
	}
	//This calls the clickAction function that displays the administrator view. The admin panel is the default view

	/*$admin_action = array("admin_panel","user_accounts","products","categories","static_pages","customer_query");
    $arrlength = count($admin_action);

    for($i=0;$i<=$arrlength;$i++) {
    	if(strcmp($admin->clickAction($admin_action[$i])),$admin_action[$i] {
    			include ('views/'. $admin_action.'.php');
    	}

    }*/
	/*if($admin->clickAction("") == "admin_panel") {

	include('views/admin_panel.php');
	}*/
	//
	if ($admin->clickAction("user_accounts") == "user_accounts")
			include('views/user_accounts.php');
	else if($admin->clickAction("products") == "products")
			include('views/products.php');
	else 
		include('views/admin_panel.php');
	