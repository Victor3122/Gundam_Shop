<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('customer', true);

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'product_not_found':
            $ERR = "Product Not Found";
            break;
        case 'limit_full':
            $ERR = "LIMIT FULL";
            break;
        case 'stock_limit':
            $ERR = "Out of Stock";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'added_to_cart':
            $MSG = "Added To The Cart";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

$mysql = new MySQL();
$productModel = new ProductModel($mysql);

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$cart = $_SESSION['cart'];
$products = [];
$total = 0;
$available_items = 0;
foreach ($cart as $cart_item) {
    $product = $productModel->findById($cart_item->id);
    if ($product && $product->status) {
        $product->count = $cart_item->count;
        $products[] = $product;
        $total += $product->price * $cart_item->count;
        $available_items++;
    } else {
        $products[] = (object)[];
    }
}
require_once '../views/cart.php';
