<?php
// include the configs / constants for the database connection
require_once("../config/db.php");

// load the login class
require_once("classes/Category.php");

$category = new ProductCategory();

include('views/category_page.php');