<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\StaffModel;

$auth = Auth::checkAuth('staff', true, ['permit_roles' => ['Admin']]);

if (isset($_POST['submit'])) {
    $staffModel = new StaffModel(new MySQL());

    $user = $staffModel->findByPhoneOrEmail($_POST['phone'], $_POST['email']);
    if ($user) HTTP::redirect('/controllers/account_manager.php', 'ERR=acc_exist');

    $inserted_id = $staffModel->register([
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'password' => $_POST['password'],
        'role' => $_POST['role'],
    ]);
    if (!$inserted_id) HTTP::redirect('/controllers/account_manager.php', 'ERR=register_failed');

    HTTP::redirect('/controllers/account_manager.php', 'MSG=registered');
}
