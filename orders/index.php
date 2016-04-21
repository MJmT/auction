<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/orders/classes/Order.php');


$order = new Order();

if(isset($_GET['order_code']))
	include('views/order_confirmation.php');

if(isset($order->show_payment_page)) {
	header("Location: $_SERVER[REQUEST_URI]");

	include('views/payment.php');
}