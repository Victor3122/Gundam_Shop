<?php

namespace Models;

class StaffModel
{
    function __construct(private $mysql)
    {
    }

    function register(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $uid = time() . uniqid(rand(), true);
        $query = "INSERT INTO staffs(uid,name,phone,email,address,password,role_id,created_at) VALUES('$uid', :name, :phone, :email, :address, :password, :role, NOW())";
        $inserted_id = $this->mysql->insertData($query, $data);
        return $inserted_id;
    }
    function findByEmailAndPassword(string $email, string $password)
    {
        $query = 'SELECT staffs.*, roles.name AS role FROM staffs LEFT JOIN roles ON staffs.role_id=roles.id WHERE staffs.email=:email';
        $user = $this->mysql->getData($query, ['email' => $email]);
        if (!$user) return false;
        if (password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
    function findById(int $id)
    {
        $query = 'SELECT staffs.*, roles.name AS role, roles.level FROM staffs LEFT JOIN roles ON staffs.role_id=roles.id WHERE staffs.id=:id';
        return $this->mysql->getData($query, ['id' => $id]);
    }
    function findByUid(int $uid)
    {
        $query = 'SELECT staffs.*, roles.name AS role FROM staffs LEFT JOIN roles ON staffs.role_id=roles.id WHERE staffs.uid=:uid';
        return $this->mysql->getData($query, ['uid' => $uid]);
    }
    function findByPhoneOrEmail(string $phone, string $email)
    {
        $query = 'SELECT * FROM staffs WHERE phone=:phone OR email=:email';
        return $this->mysql->getData($query, ['phone' => $phone, 'email' => $email]);
    }
    function findAll()
    {
        $query = 'SELECT staffs.*, roles.name AS role FROM staffs LEFT JOIN roles ON staffs.role_id=roles.id';
        return $this->mysql->getArrayData($query);
    }
    function changeImage(int $user_id, string $image)
    {
        $query = 'UPDATE staffs SET image=:image WHERE id=:id';
        return $this->mysql->modifyData($query, ['image' => $image, 'id' => $user_id]);
    }
    function changeRole(int $user_id, int $role_id)
    {
        $query = 'UPDATE staffs SET role_id=:role_id WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $user_id, 'role_id' => $role_id,]);
    }
    function suspend(int $id)
    {
        $query = 'UPDATE staffs SET suspended=1 WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
    function unsuspend(int $id)
    {
        $query = 'UPDATE staffs SET suspended=0 WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
    function deleteById(int $user_id)
    {
        $query = 'DELETE FROM staffs WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $user_id]);
    }
}
