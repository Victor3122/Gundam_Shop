<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductImageModel;
use Models\ProductModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$id = $_GET['id'];

$mysql = new MySQL();
$productModel = new ProductModel($mysql);
$productImageModel = new ProductImageModel($mysql);
$product = $productModel->findById($id);

if (!$product) HTTP::redirect('/controllers/product_manager.php', 'ERR=product_not_found');
$images = $productImageModel->findAllByProductId($product->id);

$success = $productModel->deleteById($id);
if (!$success) HTTP::redirect('/controllers/product_manager.php', 'ERR=delete_product_failed');

if ($product->image !== 'default.jpg') unlink("images/products/$product->image");
foreach ($images as $image) {
    unlink("images/products/$image->image");
}
HTTP::redirect('/controllers/product_manager.php', 'MSG=product_deleted');
