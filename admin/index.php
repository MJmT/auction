<?php
// include the configs / constants for the database connection
require_once("../config/db.php");

// load the login class
require_once("../classes/Admin.php");


	$admin = new Admin();

	if($_SESSION["user_privilege"]!=100) {
		header("Location: error.php");
		exit;
	}
?>