<?php
include '../autoload.php';

use Helpers\Auth;
use Helpers\HTTP;
use Models\MySQL;
use Models\ProductImageModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'delete_image_failed':
            $ERR = "Failed to delete image";
            break;
        case 'img_not_found':
            $ERR = "Image Not Found";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'image_deleted':
            $MSG = "Image Deleted";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

$id = $_GET['id'];
$mysql = new MySQL();
$productImageModel = new ProductImageModel($mysql);

if (isset($_POST['submit'])) {

    $countfiles = count($_FILES['images']['name']);

    $totalFileUploaded = 0;
    for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['images']['name'][$i];

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        $uname = time() . uniqid(rand(), true) . ".$extension";
        $location = "images/products/" . $uname;

        ## File upload allowed extensions
        $valid_extensions = ["jpg", "jpeg", "png"];

        ## Check file extension
        if (in_array(strtolower($extension), $valid_extensions)) {
            ## Upload file
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $location)) {
                $success = $productImageModel->uploadImage($id, $uname);
            }
        }
    }
    HTTP::redirect('/controllers/product_images.php', "id=$id");
}

$images = $productImageModel->findAllByProductId($id);

require_once('../views/product_images.php');
