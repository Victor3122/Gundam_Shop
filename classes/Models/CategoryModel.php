<?php

namespace Models;

class CategoryModel
{
    function __construct(private $mysql)
    {
    }

    function findAll(bool $orderByLevel = false)
    {
        $query = 'SELECT * FROM categories';
        if ($orderByLevel) $query .= ' ORDER BY level DESC';
        return $this->mysql->getArrayData($query);
    }
    function findById(int $id)
    {
        $query = 'SELECT * FROM categories WHERE id=:id';
        return $this->mysql->getData($query, ['id' => $id]);
    }
    function insert(array $data)
    {
        $query = "INSERT INTO categories(name, level) VALUES(:name, :level)";
        $inserted_id = $this->mysql->insertData($query, $data);
        return $inserted_id;
    }
    function modify(int $id, string $name, int $level)
    {
        $query = 'UPDATE categories SET name=:name, level=:level WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id, 'name' => $name, 'level' => $level]);
    }
    function deleteById(int $id)
    {
        $query = 'DELETE FROM categories WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
}

