<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/orders/classes/Order.php');


$order = new Order();

include_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/layout/layout_header.php');
if(isset($_GET['order_code']))
	include('views/order_confirmation.php');

if(isset($order->show_payment_page)) {
	

	include('views/payment.php');
}