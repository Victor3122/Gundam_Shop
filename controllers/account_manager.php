<?php
include '../autoload.php';
// Authorization
use Helpers\Auth;
use Models\MySQL;
use Models\CustomerModel;
use Models\RoleModel;
use Models\StaffModel;

$auth = Auth::checkAuth('staff', true, ['permit_roles' => ['Admin']]);

if (isset($_GET['ERR'])) {
    switch ($_GET['ERR']) {
        case 'delete_acc_failed':
            $ERR = "Failed to delete account";
            break;
        case 'suspend_acc_failed':
            $ERR = "Failed to suspend";
            break;
        case 'unsuspend_acc_failed':
            $ERR = "Failed to unsuspend";
            break;
        case 'chg_role_failed':
            $ERR = "Failed to change role";
            break;
        case 'acc_exist':
            $ERR = "Account already exist with this phone or email";
            break;
        case 'register_failed':
            $ERR = "Failed to create account";
            break;
        default:
            $ERR = "Something went wrong";
            break;
    }
}

if (isset($_GET['MSG'])) {
    switch ($_GET['MSG']) {
        case 'acc_deleted':
            $MSG = "Account Deleted";
            break;
        case 'registered':
            $MSG = "Created new staff account";
            break;
        case 'acc_suspended':
            $MSG = "Account Suspended";
            break;
        case 'acc_unsuspended':
            $MSG = "Account Unsuspended";
            break;
        case 'role_changed':
            $MSG = "Role Changed";
            break;
        default:
            $MSG = $_GET['MSG'];
            break;
    }
}

$mysql = new MySQL();
$customerModel = new CustomerModel($mysql);
$staffModel = new StaffModel($mysql);
$roleModel = new RoleModel($mysql);

$customers = $customerModel->findAll();
$staffs = $staffModel->findAll();
$roles = $roleModel->findAll();

require_once '../views/account_manager.php';
