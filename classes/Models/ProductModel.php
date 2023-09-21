<?php

namespace Models;

class ProductModel
{
    function __construct(private $mysql)
    {
    }

    function insert(array $data)
    {
        $query = "INSERT INTO products(name,image,size,description,price,stock,category_id,status) VALUES(:name, :image, :size, :description, :price, :stock, :category, :status)";
        $inserted_id = $this->mysql->insertData($query, $data);
        return $inserted_id;
    }
    function findById(int $id)
    {
        $query = 'SELECT products.*, categories.name AS category, categories.level FROM products LEFT JOIN categories ON products.category_id=categories.id WHERE products.id=:id';
        return $this->mysql->getData($query, ['id' => $id]);
    }
    function findAll(string $search = null, array $categories = [])
    {
        $query = 'SELECT products.*, categories.name AS category, categories.level FROM products LEFT JOIN categories ON products.category_id=categories.id';
        if ($search or count($categories)) $query .= ' WHERE ';
        if ($search) $query .= "products.name LIKE :search";

        for ($i = 0; $i < count($categories); $i++) {
            if ($i === 0) {
                if ($search) {
                    $query .= ' AND (';
                    $need_close = true;
                }
            } else {
                $query .= ' OR ';
            }
            $query .= "products.category_id=$categories[$i]";
        }
        if (isset($need_close)) $query .= ')';

        return $this->mysql->getArrayData($query, $search ? ['search' => "%$search%"] : []);
    }

    function findAllAvailablesByCategoryId(int $category, string $search = null)
    {
        $query = 'SELECT products.*, categories.name AS category, categories.level FROM products LEFT JOIN categories ON products.category_id=categories.id WHERE products.status=1 AND products.category_id=:category';
        $data = ['category' => $category];
        if ($search) {
            $query .= ' AND products.name LIKE :search';
            $data['search'] = "%$search%";
        }
        return $this->mysql->getArrayData($query, $data);
    }
    function findTopFourAvailablesByCategoryId(int $category, string $search = null)
    {
        $query = 'SELECT products.*, categories.name AS category, categories.level FROM products LEFT JOIN categories ON products.category_id=categories.id WHERE products.status=1 AND products.category_id=:category LIMIT 4';
        $data = ['category' => $category];
        if ($search) {
            $query .= ' AND products.name LIKE :search';
            $data['search'] = "%$search%";
        }
        return $this->mysql->getArrayData($query, $data);
    }
    // API
    function findRandom()
    {
        $query = 'SELECT products.*, categories.name AS category, categories.level FROM products LEFT JOIN categories ON products.category_id=categories.id ORDER BY RAND() LIMIT 1';
        return $this->mysql->getData($query);
    }
    function changeImage(int $id, string $image)
    {
        $query = 'UPDATE products SET image=:image WHERE id=:id';
        return $this->mysql->modifyData($query, ['image' => $image, 'id' => $id]);
    }
    function changeStatus(int $id, int $status)
    {
        $query = 'UPDATE products SET status=:status WHERE id=:id';
        return $this->mysql->modifyData($query, ['status' => $status, 'id' => $id]);
    }
    function modify(array $data)
    {
        $query = 'UPDATE products SET name=:name, image=:image, size=:size, price=:price, description=:description, stock=:stock, category_id=:category WHERE id=:id';
        return $this->mysql->modifyData($query, $data);
    }
    function modifyStock(int $id, int $stock)
    {
        $query = 'UPDATE products SET stock=:stock WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id, 'stock' => $stock]);
    }
    function deleteById(int $id)
    {
        $query = 'DELETE FROM products WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
    function deleteByCategoryId(int $id)
    {
        $query = 'DELETE FROM products WHERE category_id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
}
