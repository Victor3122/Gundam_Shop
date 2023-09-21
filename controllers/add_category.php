<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CategoryModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$name = $_POST['name'];
$level = $_POST['level'];

$categoryModel = new CategoryModel(new MySQL());
$inserted_id = $categoryModel->insert([
    'name' => $name,
    'level' => $level
]);
if (!$inserted_id) HTTP::redirect('/controllers/product_manager.php', 'ERR=add_category_failed');
HTTP::redirect('/controllers/product_manager.php', 'MSG=category_added');
