<?php

include '../autoload.php';

use Helpers\Auth;
use Helpers\HTTP;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('customer', true);

$mysql = new MySQL();
$productModel = new ProductModel($mysql);

$cart = $_SESSION['cart'];
$products = [];
$total = 0;
$available_items = 0;
foreach ($cart as $item) {
    $product = $productModel->findById($item->id);
    if ($product && $product->status) {
        if ($product->stock >= $item->count) {
            $product->count = $item->count;
            $products[] = $product;
            $total += ($product->price * $item->count);
            $available_items += $item->count;
        }
    } else {
        $products[] = (object)[];
    }
}

require_once '../views/checkout.php';
