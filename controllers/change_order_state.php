<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\OrderModel;
use Models\OrderDetailModel;
use Models\ProductModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$id = $_GET['id'];
$state = (int)$_GET['state'];

$valid_states = [1, 2, 3, 4];
if (!in_array($state, $valid_states)) {
    HTTP::redirect('/controllers/order_manager.php', 'ERR=invalid_state');
}
$mysql = new MySQL();
$orderModel = new OrderModel($mysql);

if ($state === 2) {
    $orderDetailModel = new OrderDetailModel($mysql);
    $order_items = $orderDetailModel->findByOrderId($id);
    foreach ($order_items as $order_item) {
        $productModel = new ProductModel($mysql);
        $product = $productModel->findById($order_item->product_id);
        if ($product->stock < $order_item->count)  HTTP::redirect('/controllers/order_manager.php', 'ERR=stock_insufficient');
        $productModel->modifyStock($product->id, ($product->stock - $order_item->count));
    }
}
$success = $orderModel->updateState($id, $state);
if (!$success) HTTP::redirect('/controllers/order_manager.php', 'ERR=chg_state_failed');

HTTP::redirect('/controllers/order_manager.php', 'MSG=state_changed');
