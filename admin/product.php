<?php

require_once("config/db.php");

// load the registration class
require_once("classes/ProductCreation.php");

$product = new ProductCreation();

 include('views/products.php');
