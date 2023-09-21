<?php
include '../autoload.php';

use Helpers\Auth;
use Helpers\HTTP;
use Models\MySQL;
use Models\CustomerModel;
use Models\StaffModel;

$auth = Auth::checkAuth('both', true);
$type = isset($auth->role_id) ? 'staff' : 'customer';
$old_img = $auth->image;
$img = $_FILES['image'];

if ($img['error'] !== 0) {
    HTTP::redirect('../controllers/profile.php', "ERR=upload_failed&id=$auth->id&type=$type");
}
$extension = explode('/', $img['type'])[1];
$uname = time() . uniqid(rand(), true) . ".$extension";
$success = move_uploaded_file($img['tmp_name'], "images/users/$uname");
if (!$success) HTTP::redirect('../controllers/profile.php', "ERR=upload_failed&id=$auth->id&type=$type");
$mysql = new MySQL();
if (isset($auth->role_id)) {
    $staffModel = new StaffModel($mysql);
    $updated = $staffModel->changeImage($auth->id, $uname);
} else {
    $customerModel = new CustomerModel($mysql);
    $updated = $customerModel->changeImage($auth->id, $uname);
}

if (!$updated) HTTP::redirect('../controllers/profile.php', "ERR=upload_failed&id=$auth->id&type=$type");
if ($old_img != 'default.jpg') {
    unlink("images/users/$old_img");
}
HTTP::redirect('../controllers/profile.php', "MSG=uploaded&id=$auth->id&type=$type");
