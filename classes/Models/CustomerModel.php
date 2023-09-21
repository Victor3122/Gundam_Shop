<?php

namespace Models;

class CustomerModel
{
    function __construct(private $mysql)
    {
    }

    function register(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $uid = time() . uniqid(rand(), true);
        $query = "INSERT INTO customers(uid,name,phone,email,address,password,created_at) VALUES('$uid', :name, :phone, :email, :address, :password, NOW())";
        $inserted_id = $this->mysql->insertData($query, $data);
        return $inserted_id;
    }
    function findByEmailAndPassword(string $email, string $password)
    {
        $query = 'SELECT * FROM customers WHERE email=:email';
        $user = $this->mysql->getData($query, ['email' => $email]);
        if (!$user) return false;
        if (password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
    function findById(int $id)
    {
        $query = 'SELECT * FROM customers WHERE id=:id';
        return $this->mysql->getData($query, ['id' => $id]);
    }
    function findByUid(int $uid)
    {
        $query = 'SELECT * FROM customers WHERE uid=:uid';
        return $this->mysql->getData($query, ['uid' => $uid]);
    }
    function findByPhoneOrEmail(string $phone, string $email)
    {
        $query = 'SELECT * FROM customers WHERE phone=:phone OR email=:email';
        return $this->mysql->getData($query, ['phone' => $phone, 'email' => $email]);
    }
    function findAll()
    {
        $query = 'SELECT * FROM customers';
        return $this->mysql->getArrayData($query);
    }
    function changeImage(int $id, string $image)
    {
        $query = 'UPDATE customers SET image=:image WHERE id=:id';
        return $this->mysql->modifyData($query, ['image' => $image, 'id' => $id]);
    }
    function suspend(int $id)
    {
        $query = 'UPDATE customers SET suspended=1 WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
    function unsuspend(int $id)
    {
        $query = 'UPDATE customers SET suspended=0 WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
    function deleteById(int $id)
    {
        $query = 'DELETE FROM customers WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
}
