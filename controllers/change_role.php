<?php
include '../autoload.php';

use Helpers\Auth;
use Helpers\HTTP;
use Models\MySQL;
use Models\StaffModel;

$auth = Auth::checkAuth('staff', true, ['permit_roles' => ['Admin']]);

$user_id = $_GET['user'];
$role_id = $_GET['role'];

$staffModel = new StaffModel(new MySQL());
$success = $staffModel->changeRole($user_id, $role_id);

if (!$success) HTTP::redirect('/controllers/account_manager.php', 'ERR=chg_role_failed');
HTTP::redirect('/controllers/account_manager.php', 'MSG=role_changed');
