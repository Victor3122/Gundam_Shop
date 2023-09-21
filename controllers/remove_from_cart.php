<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\ProductModel;

$auth = Auth::checkAuth('customer', true);

$id = $_GET['id'];
$count = (int)$_GET['count'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

for ($i = 0; $i < count($_SESSION['cart']); $i++) {
    $item = $_SESSION['cart'][$i];
    if ($item->id === $id) {
        $item->count -= $count;
        if ($item->count <= 0) {
            array_splice($_SESSION['cart'], $i, 1);
        }
        HTTP::redirect("/controllers/cart.php", 'MSG=removed_from_cart');
    }
    HTTP::redirect("/controllers/cart.php", 'ERR=failed_to_remove');
}
