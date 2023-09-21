<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CategoryModel;
use Models\ProductModel;
use Models\ProductImageModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$id = $_GET['id'];
$mysql = new MySQL();
$categoryModel = new CategoryModel($mysql);
$productModel = new ProductModel($mysql);
$productImageModel = new ProductImageModel($mysql);

$success = $categoryModel->deleteById($id);
if (!$success) HTTP::redirect('/controllers/product_manager.php', 'ERR=delete_category_failed');

$products = $productModel->findAll(null, [$id]);
$productModel->deleteByCategoryId($id);

foreach ($products as $product) {
    if ($product->image !== 'default.jpg') unlink("images/products/$product->image");
    $images = $productImageModel->findAllByProductId($product->id);
    foreach ($images as $image) {
        unlink("images/products/$image->image");
    }
}

HTTP::redirect('/controllers/product_manager.php', 'MSG=category_deleted');
