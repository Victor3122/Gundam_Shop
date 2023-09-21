<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CategoryModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$categoryModel = new CategoryModel(new MySQL());

if (isset($_POST['submit'])) {
    $id = $_POST['_id'];
    $name = $_POST['name'];
    $level = $_POST['level'];

    $success = $categoryModel->modify($id, $name, $level);
    if (!$success) HTTP::redirect('/controllers/product_manager.php', 'ERR=modify_category_failed');
    HTTP::redirect('/controllers/product_manager.php', 'MSG=category_modified');
} else {
    $id = $_GET['id'];

    $category = $categoryModel->findById($id);
    if (!$category) HTTP::redirect('/controllers/product_manager.php', 'ERR=category_not_found');
    require_once('../views/modify_category.php');
}
