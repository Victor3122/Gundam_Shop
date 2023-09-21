<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CustomerModel;

$auth = Auth::checkAuth('both', false);
if (isset($_SESSION['accounts'])) $accounts = $_SESSION['accounts'];

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'incorrect':
            $ERR = "Wrong Identity";
            break;
        case 'suspended':
            $ERR = "Your account is banned";
            break;
        case 'auth_require':
            $ERR = "This process requires account";
            break;
        case 'psw_changed':
            $ERR = "Session Expired or password is changed";
            break;
        case 'acc_not_found':
            $ERR = "Your account may be deleted";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'registered':
            $MSG = "Account Created";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mysql = new MySQL();
    $customerModel = new CustomerModel($mysql);

    $user = $customerModel->findByEmailAndPassword($email, $password);

    if (!$user) {
        $ERR = 'Wrong Identity';
        require_once '../views/customer_login.php';
        exit();
    }
    if ($user->suspended) {
        $ERR = 'Your account is banned';
        require_once '../views/customer_login.php';
        exit();
    }

    if (!isset($_SESSION['accounts'])) {
        $_SESSION['accounts'] = [];
    }

    $accounts = [];
    foreach ($_SESSION['accounts'] as $account) {
        if ($account->uid !== $user->uid) $accounts[] = $account;
    }
    $accounts[] = $user;

    $_SESSION['accounts'] = $accounts;
    $_SESSION['current_user'] = $user->uid;
    $_SESSION['cart'] = [];

    HTTP::redirect('/controllers/home.php');
}
require_once '../views/customer_login.php';
