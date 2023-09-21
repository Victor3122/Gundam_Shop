<?php
include '../autoload.php';

use Helpers\Auth;
use Models\ProductModel;
use Models\MySQL;
use Models\OrderDetailModel;
use Models\OrderModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'chg_state_failed':
            $ERR = "Failed to Change Order State";
            break;
        case 'stock_insufficient':
            $ERR = "Insufficient Stock";
            break;
        case 'invalid_state':
            $ERR = "Invalid Request";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'state_changed':
            $MSG = "State Changed Successfully";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

$state = isset($_GET['state']) ? $_GET['state'] : false;

$mysql = new MySQL();
$orderModel = new OrderModel($mysql);
$orderDetailModel = new OrderDetailModel($mysql);

$orders = $state ? $orderModel->findByStateId($state, true) : $orderModel->findAll(true);
foreach ($orders as $order) {
    $order->details = $orderDetailModel->findByOrderId($order->id, true);
}

require_once('../views/order_manager.php');
