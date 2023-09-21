<?php

namespace Models;

use PDO;
use PDOException;

class MySQL
{
    private $db;
    function __construct(
        private string $host = 'localhost',
        private string $dbname = 'gundam_shop',
        private string $user = 'root',
        private string $password = ''
    ) {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->db = new PDO(
                $dsn,
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );

            // return $this->db;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getData(string $query, array $data = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($data);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function getArrayData(string $query, array $data = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($data);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function insertData(string $query, array $data)
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function modifyData(string $query, array $data)
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($data);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
