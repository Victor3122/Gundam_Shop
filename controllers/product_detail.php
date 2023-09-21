<?php
include '../autoload.php';

use Helpers\Auth;
use Models\CategoryModel;
use Models\ProductModel;
use Models\MySQL;
use Models\ProductImageModel;

$auth = Auth::checkAuth('both', false);

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

$id = $_GET['id'];
$mysql = new MySQL();
$productModel = new ProductModel($mysql);
$productImageModel = new ProductImageModel($mysql);

$product = $productModel->findById($id);
if ($product) $product->images = $productImageModel->findAllByProductId($product->id);

require_once('../views/product_detail.php');
