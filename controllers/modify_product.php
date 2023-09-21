<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CategoryModel;
use Models\ProductModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$mysql = new MySQL();
$categoryModel = new CategoryModel($mysql);
$productModel = new ProductModel($mysql);

if (isset($_POST['submit'])) {
    $current_image = $_POST['_image'];

    $image = $_FILES['image'];
    if ($image['error'] === 4) {
        $uname = $current_image;
        $use_current_image = true;
    } elseif ($image['error'] === 0) {
        $type = explode('/', $image['type'])[1];
        $uname = time() . uniqid(rand(), true) . ".$type";
        $success = move_uploaded_file($image['tmp_name'], "images/products/$uname");
        if (!$success) HTTP::redirect('../controllers/product_manager.php', 'ERR=img_error');
    } else {
        HTTP::redirect('/controllers/product_manager.php', 'ERR=img_error');
    }

    $success = $productModel->modify([
        'id' => $_POST['_id'],
        'name' => $_POST['name'],
        'image' => $uname,
        'size' => $_POST['size'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
        'stock' => $_POST['stock'],
        'category' => $_POST['category'],
    ]);
    if (!$success) {
        if ($uname !== 'default.jpg') unlink("images/products/$uname");
        HTTP::redirect('/controllers/product_manager.php', 'ERR=modify_product_failed');
    }
    if ($current_image !== 'default.jpg'&& !isset ($use_current_image)) unlink("images/products/$current_image");
    HTTP::redirect('/controllers/product_manager.php', 'MSG=product_modified');
} else {
    $id = $_GET['id'];

    $product = $productModel->findById($id);
    if (!$product) HTTP::redirect('/controllers/product_manager.php', 'ERR=product_not_found');

    $categories = $categoryModel->findAll();
    require_once('../views/modify_product.php');
}
