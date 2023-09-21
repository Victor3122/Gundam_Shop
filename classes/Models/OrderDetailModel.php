<?php

namespace Models;

class OrderDetailModel
{
    function __construct(private $mysql)
    {
    }

    function findByOrderId(int $order_id)
    {
        $query = 'SELECT order_details.*, products.image FROM order_details LEFT JOIN products ON order_details.product_id=products.id WHERE order_details.order_id=:order_id';
        return $this->mysql->getArrayData($query, ['order_id' => $order_id]);
    }
    function insert(array $data)
    {
        $query = 'INSERT INTO order_details(order_id, product_id, product_name, price, count) VALUES(:order_id, :product_id, :product_name, :price, :count)';
        return $this->mysql->insertData($query, $data);
    }
}
