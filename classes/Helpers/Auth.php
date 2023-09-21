<?php

namespace Helpers;

use Models\MySQL;
use Models\CustomerModel;
use Models\StaffModel;

class Auth
{
    public static function checkAuth(
        string $actionType = 'both',
        bool $mandatory = true,
        array $authorization = ['minimum_level' => 1, 'permit_roles' => ['Admin', 'Staff']]
    ) {
        session_start();
        $redirect = 'customer_login';
        if ($actionType === 'staff') $redirect = 'staff_login';

        if (!isset($_SESSION['current_user']) || !isset($_SESSION['accounts'])) return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=auth_require') : false;


        $current_user_uid = $_SESSION['current_user'];
        $accounts = $_SESSION['accounts'];
        foreach ($accounts as $account) {
            if ($account->uid === $current_user_uid) $user = $account;
        }

        if (!$user)  return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=auth_require') : false;

        // Check with database
        if (!isset($user->role_id)) {
            $redirect = 'customer_login';
            $customerModel = new CustomerModel(new MySQL());
            $db_data = $customerModel->findById($user->id);
        }
        if (isset($user->role_id)) {
            $redirect = 'staff_login';
            $staffModel = new StaffModel(new MySQL());
            $db_data = $staffModel->findById($user->id);
        }
        if (!$db_data)  return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=acc_not_found') : false;
        if ($user->password !== $db_data->password)  return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=psw_changed') : false;

        for ($i = 0; $i < count($accounts); $i++) {
            if ($accounts[$i]->uid === $current_user_uid) $_SESSION['accounts'][$i] = $db_data;
        }
        if ($db_data->suspended)  return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=suspended') : false;

        // check acc type (customer, staff, both)
        if ($actionType === 'customer') {
            if (isset($db_data->role_id)) return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=auth_require') : false;
        } elseif ($actionType === 'staff') {
            if (!isset($db_data->role_id)) return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=auth_require') : false;

            $permit1 = false;
            $permit2 = false;
            if (isset($authorization['minimum_level'])) {
                $permit1 = $authorization['minimum_level'] <= $db_data->level ? true : false;
            }
            if (isset($authorization['permit_roles'])) {
                $permit2 = in_array($db_data->role, $authorization['permit_roles']);
            }

            if (!$permit1 && !$permit2)  return $mandatory ? HTTP::redirect("/controllers/$redirect.php", 'ERR=forbidden') : false;
        }
        return $db_data;
    }
}
