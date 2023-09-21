<?php

include '../autoload.php';

use Helpers\Auth;
use Models\CategoryModel;
use Models\MySQL;
use Models\ProductModel;

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

$mysql = new MySQL();
$categoryModel = new CategoryModel($mysql);
$productModel = new ProductModel($mysql);

$categories = $categoryModel->findAll(true);
foreach ($categories as $category) {
    $category->products = $productModel->findTopFourAvailablesByCategoryId($category->id);
}

require_once('../views/home.php');
