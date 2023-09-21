<?php

include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\OrderDetailModel;
use Models\OrderModel;

$auth = Auth::checkAuth('customer', true);

$mysql = new MySQL();
$orderModel = new OrderModel($mysql);
$orderDetailModel = new OrderDetailModel($mysql);

$orders = $orderModel->findByCustomerId($auth->id, true);
foreach ($orders as $order) {
    $order->details = $orderDetailModel->findByOrderId($order->id, true);
}

require_once('../views/orders.php');
