<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CustomerModel;
use Models\StaffModel;

$auth = Auth::checkAuth('staff', true, ['permit_roles' => ['Admin']]);

$id = $_GET['id'];
$type = $_GET['type'];
$mode = $_GET['mode'];

$mysql = new MySQL();
if ($type === 'customer') {
    $userModel = new CustomerModel($mysql);
} elseif ($type === 'staff') {
    $userModel = new StaffModel($mysql);
}

if ($mode === 'suspend') {
    $success = $userModel->suspend($id);
} elseif ($mode === 'unsuspend') {
    $success = $userModel->unsuspend($id);
}
if (!$success) HTTP::redirect('/controllers/account_manager.php', "ERR={$mode}_acc_failed");
HTTP::redirect('/controllers/account_manager.php', "MSG=acc_{$mode}ed");
