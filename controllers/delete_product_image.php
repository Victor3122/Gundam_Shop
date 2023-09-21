<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductImageModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$id = $_GET['id'];
$pid = $_GET['_pid'];
$mysql = new MySQL();
$productImageModel = new ProductImageModel($mysql);

$image = $productImageModel->findById($id);
if (!$image) HTTP::redirect('/controllers/product_images.php', "id=$pid&ERR=img_not_found");

$success = $productImageModel->deleteById($id);
if (!$success) HTTP::redirect('/controllers/product_images.php', "id=$pid&ERR=delete_image_failed");

unlink("images/products/$image->image");
HTTP::redirect('/controllers/product_images.php', "id=$pid&MSG=image_deleted");
