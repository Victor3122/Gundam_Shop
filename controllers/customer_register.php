<?php
include '../autoload.php';

use Helpers\HTTP;
use Helpers\Auth;
use Models\MySQL;
use Models\CustomerModel;

$auth = Auth::checkAuth('both', false);

if (isset($_POST['submit'])) {
    $customerModel = new CustomerModel(new MySQL());

    $user = $customerModel->findByPhoneOrEmail($_POST['phone'], $_POST['email']);
    if ($user) {
        $ERR = 'Account already exist with this phone or email';
        require_once '../views/customer_register.php';
        exit();
    }

    $inserted_id = $customerModel->register([
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'password' => $_POST['password'],
    ]);
    if (!$inserted_id) {
        $ERR = 'Failed to create account';
        require_once '../views/customer_register.php';
        exit();
    }

    HTTP::redirect('/controllers/customer_login.php', 'MSG=registered');
}
require_once '../views/customer_register.php';
