<?php
include '../autoload.php';

use Helpers\HTTP;

session_start();
$uid = $_GET['uid'];
$_SESSION['current_user'] = $uid;
if (isset($_SESSION['cart'])) unset($_SESSION['cart']);
HTTP::redirect('/controllers/home.php');
