<?php
include '../autoload.php';
// Authorization
use Helpers\Auth;
use Helpers\HTTP;
use Models\CustomerModel;
use Models\MySQL;
use Models\StaffModel;

$auth = Auth::checkAuth('staff', true, ['permit_roles' => ['Admin']]);

$id = $_GET['id'];
$type = $_GET['type'];

$mysql = new MySQL();

if ($type === 'customer') {
    $customerModel = new CustomerModel($mysql);
    $user = $customerModel->findById($id);
    $success = $customerModel->deleteById($id);
} elseif ($type === 'staff') {
    $staffModel = new StaffModel($mysql);
    $user = $staffModel->findById($id);
    $success = $staffModel->deleteById($id);
}
if (!$success) HTTP::redirect('/controllers/account_manager.php', 'ERR=delete_acc_failed');
if ($user->image !== 'default.jpg') unlink("images/users/$user->image");

HTTP::redirect('/controllers/account_manager.php', 'MSG=acc_deleted');
