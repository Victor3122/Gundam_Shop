<?php

include '../autoload.php';

use Helpers\Auth;
use Helpers\HTTP;
use Models\MySQL;
use Models\ProductModel;
use Models\OrderModel;
use Models\OrderDetailModel;


$auth = Auth::checkAuth('customer', true);

$address = $_POST['address'];
$cart = $_SESSION['cart'];
$total_price = 0;
$mysql = new MySQL();
$productModel = new ProductModel($mysql);
$orderModel = new OrderModel($mysql);
$orderDetailModel = new OrderDetailModel($mysql);
$products = [];

foreach ($cart as $item) {
    $product = $productModel->findById($item->id);
    if (isset($product) && $product->status) {
        if ($product->stock >= $item->count) {
            $product->count = $item->count;
            $products[] = $product;
            $total_price += ($product->price * $item->count);
        }
    }
}
$order_id = $orderModel->insert(['customer_id' => $auth->id, 'total_price' => $total_price, 'address' => $address]);

if (!$order_id) HTTP::redirect('/controllers/checkout.php', 'ERR=failed_to_order');

foreach ($products as $product) {
    $orderDetailModel->insert(['order_id' => $order_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'count' => $product->count]);
}

HTTP::redirect('/controllers/orders.php', 'MSG=ordered');
