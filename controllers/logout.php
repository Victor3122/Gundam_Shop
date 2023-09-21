<?php
include '../autoload.php';

use Helpers\HTTP;

$uid = $_GET['uid'];
session_start();

$accounts = [];
foreach ($_SESSION['accounts'] as $account) {
    if ($account->uid !== $uid) $accounts[] = $account;
}

$_SESSION['accounts'] = $accounts;
if (isset($_SESSION['current_user'])) {
    if ($_SESSION['current_user'] == $_GET['uid']) {
        unset($_SESSION['current_user']);
        if (isset($_SESSION['cart'])) unset($_SESSION['cart']);
    }
}

HTTP::redirect('/controllers/customer_login.php');
