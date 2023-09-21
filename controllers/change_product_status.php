<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('staff', true, ['minimum_level' => 1]);

$id = $_GET['id'];
$status = $_GET['status'];

$productModel = new ProductModel(new MySQL());
$success = $productModel->changeStatus($id, $status);

if (!$success) HTTP::redirect('/controllers/product_manager.php', 'ERR=chg_status_failed');
HTTP::redirect('/controllers/product_manager.php', 'MSG=status_changed');
