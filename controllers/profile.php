<?php
include '../autoload.php';

use Helpers\Auth;
use Models\CustomerModel;
use Models\MySQL;
use Models\StaffModel;

$auth = Auth::checkAuth('both');
if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'upload_failed':
            $ERR = "Failed to upload Profile Picture";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}
if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'uploaded':
            $MSG = "Profile Picture Uploaded Succesfully";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

$id = $_GET['id'];
$type = $_GET['type'];

$mysql = new MySQL();
if ($type === 'customer') {
    $customerModel = new CustomerModel($mysql);
    $user = $customerModel->findById($id);
} elseif ($type === 'staff') {
    $staffModel = new StaffModel($mysql);
    $user = $staffModel->findById($id);
}

$isItMe = false;
if (isset($user)) {
    $isItMe = $user->uid === $auth->uid;
}

require_once '../views/profile.php';
