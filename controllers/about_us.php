<?php
include '../autoload.php';

use Helpers\Auth;

$auth = Auth::checkAuth('both', false);

require_once '../views/about_us.php';
