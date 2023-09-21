<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$name = $_POST['name'];
$size = $_POST['size'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$category = $_POST['category'];
$status = isset($_POST['status']) ? 1 : 0;
$image = $_FILES['image'];


if ($image['error'] === 4) {
    $uname = 'default.jpg';
} elseif ($image['error'] === 0) {
    $type = explode('/', $image['type'])[1];
    $uname = time() . uniqid(rand(), true) . ".$type";
    $success = move_uploaded_file($image['tmp_name'], "images/products/$uname");
    if (!$success) HTTP::redirect('../controllers/product_manager.php', 'ERR=img_error');
} else {
    HTTP::redirect('/controllers/product_manager.php', 'ERR=img_error');
}

$productModel = new ProductModel(new MySQL());
$inserted_id = $productModel->insert([
    'name' => $name,
    'image' => $uname,
    'size' => $size,
    'description' => $description,
    'price' => $price,
    'stock' => $stock,
    'category' => $category,
    'status' => $status
]);
if (!$inserted_id) HTTP::redirect('/controllers/product_manager.php', 'ERR=add_product_failed');
HTTP::redirect('/controllers/product_manager.php', 'MSG=product_added');
