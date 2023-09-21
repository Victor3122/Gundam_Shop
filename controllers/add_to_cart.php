<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('customer', true);

$id = $_GET['id'];
$origin = $_GET['origin'];

if ($origin === 'home') {
    $redirect = 'home';
} elseif ($origin === 'browser') {
    $redirect = 'product_browser';
} elseif ($origin === 'detail') {
    $redirect = 'product_detail';
} elseif ($origin === 'cart') {
    $redirect = 'cart';
}

$mysql = new MySQL();
$productModel = new ProductModel($mysql);
$product = $productModel->findById($id);
if (!$product) HTTP::redirect("/controllers/$redirect.php", 'ERR=product_not_found' . ($origin === 'detail' ? "&id=$id" : ''));

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

foreach ($_SESSION['cart'] as $cart_item) {
    if ($cart_item->id == $id) {
        if ($cart_item->count >= 10) {
            HTTP::redirect("/controllers/$redirect.php", 'ERR=limit_full' . ($origin === 'detail' ? "&id=$id" : ''));
        }
        if ($cart_item->count >= $product->stock) {
            HTTP::redirect("/controllers/$redirect.php", 'ERR=stock_limit' . ($origin === 'detail' ? "&id=$id" : ''));
        }
        $cart_item->count += 1;
        HTTP::redirect("/controllers/$redirect.php", 'MSG=added_to_cart' . ($origin === 'detail' ? "&id=$id" : ''));
    }
}
if ($product->stock === 0) HTTP::redirect("/controllers/$redirect.php", 'ERR=stock_limit' . ($origin === 'detail' ? "&id=$id" : ''));
$item = (object)["id" => $id, "count" => 1];
array_push($_SESSION['cart'], $item);
HTTP::redirect("/controllers/$redirect.php", 'MSG=added_to_cart' . ($origin === 'detail' ? "&id=$id" : ''));
