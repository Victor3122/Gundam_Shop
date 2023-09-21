<?php

namespace Models;

class OrderModel
{
    function __construct(private $mysql)
    {
    }

    function findAll($order = false)
    {
        $query = 'SELECT orders.*, order_states.name AS state, customers.name AS customer_name FROM orders LEFT JOIN order_states ON orders.order_state_id=order_states.id LEFT JOIN customers ON orders.customer_id=customers.id';
        if ($order) $query .= ' ORDER BY orders.created_at DESC';
        return $this->mysql->getArrayData($query);
    }
    function findByStateId(int $order_state_id, $order = false)
    {
        $query = 'SELECT orders.*, order_states.name AS state, customers.name AS customer_name FROM orders LEFT JOIN order_states ON orders.order_state_id=order_states.id LEFT JOIN customers ON orders.customer_id=customers.id WHERE orders.order_state_id=:order_state_id';
        if ($order) $query .= ' ORDER BY orders.created_at DESC';
        return $this->mysql->getArrayData($query, ['order_state_id' => $order_state_id]);
    }
    function findByCustomerId(int $customer_id, $order = false)
    {
        $query = 'SELECT orders.*, order_states.name AS state, customers.name AS customer_name FROM orders LEFT JOIN order_states ON orders.order_state_id=order_states.id LEFT JOIN customers ON orders.customer_id=customers.id WHERE orders.customer_id=:customer_id';
        if ($order) $query .= ' ORDER BY orders.created_at DESC';
        return $this->mysql->getArrayData($query, ['customer_id' => $customer_id]);
    }
    function insert(array $data)
    {
        $query = 'INSERT INTO orders(customer_id, total_price, address, order_state_id, created_at) VALUES(:customer_id, :total_price, :address, 1, NOW())';
        return $this->mysql->insertData($query, $data);
    }
    function updateState(int $id, int $order_state_id)
    {
        $query = 'UPDATE orders SET order_state_id=:order_state_id WHERE id=:id';
        return $this->mysql->modifyData($query, ['id' => $id, 'order_state_id' => $order_state_id,]);
    }
}
