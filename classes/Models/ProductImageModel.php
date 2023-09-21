<?php

namespace Models;

class ProductImageModel
{
    function __construct(private $mysql)
    {
    }

    function findAllByProductId(int $id)
    {
        $query = 'SELECT * FROM product_images WHERE product_id=:id';
        return $this->mysql->getArrayData($query, ['id' => $id]);
    }
    function findById(int $id)
    {
        $query = 'SELECT * FROM product_images WHERE id=:id';
        return $this->mysql->getData($query, ['id' => $id]);
    }
    function uploadImage(int $id, string $image)
    {
        $query = "INSERT INTO product_images(image, product_id) VALUES(:image, :product_id)";
        $inserted_id = $this->mysql->insertData($query, ['image' => $image, 'product_id' => $id]);
        return $inserted_id;
    }
    function deleteById(int $id)
    {
        $query = 'DELETE FROM product_images WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id]);
    }
}
