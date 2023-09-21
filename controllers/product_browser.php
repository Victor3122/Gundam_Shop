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

$search = isset($_POST['search']);
if ($search) $search = $_POST['search'];

$filters = [];
if (isset($_POST['categories'])) {
    if (!isset($_POST['filter'])) $filters = $_POST['categories'];
}

$all_categories = $categoryModel->findAll(true);

$categories = [];
$products = [];
if (!$search && !count($filters)) {
    foreach ($all_categories as $category) {
        $categories = $all_categories;
        $products[] = $productModel->findAllAvailablesByCategoryId($category->id);
    }
} else {
    if (!count($filters)) $categories = $all_categories;

    foreach ($all_categories as $category) {
        if (!count($filters)) $products[] = $productModel->findAllAvailablesByCategoryId($category->id, $search);
        foreach ($filters as $filter) {
            if ($category->id == $filter) {
                $categories[] = $category;
                $products[] = $productModel->findAllAvailablesByCategoryId($filter, $search);
            }
        }
    }
}

require_once('../views/product_browser.php');
