<?php
include '../autoload.php';

use Helpers\Auth;
use Models\CategoryModel;
use Models\ProductModel;
use Models\MySQL;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'delete_product_failed':
            $ERR = "Failed to delete product";
            break;
        case 'img_error':
            $ERR = "Failed to upload image";
            break;
        case 'add_category_failed':
            $ERR = "Failed to add category";
            break;
        case 'modify_category_failed':
            $ERR = "Failed to modify category";
            break;
        case 'delete_category_failed':
            $ERR = "Failed to delete category";
            break;
        case 'category_not_found':
            $ERR = "Category Not Found";
            break;
        case 'add_product_failed':
            $ERR = "Failed to add product";
            break;
        case 'modify_product_failed':
            $ERR = "Failed to modify product";
            break;
        case 'product_not_found':
            $ERR = "Product Not Found";
            break;
        case 'chg_status_failed':
            $ERR = "Failed to change Product Availability";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'category_added':
            $MSG = "Added New Category";
            break;
        case 'category_modified':
            $MSG = "Modified Category";
            break;
        case 'category_deleted':
            $MSG = "Category Deleted";
            break;
        case 'product_added':
            $MSG = "Added New Product";
            break;
        case 'product_modified':
            $MSG = "Product Modifed";
            break;
        case 'product_deleted':
            $MSG = "Product Deleted";
            break;
        case 'status_changed':
            $MSG = "Changed Product Availability";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}
$mysql = new MySQL();
$categoryModel = new CategoryModel($mysql);
$productModel = new ProductModel($mysql);
$categories = $categoryModel->findAll();
$products = $productModel->findAll();

require_once('../views/product_manager.php');
