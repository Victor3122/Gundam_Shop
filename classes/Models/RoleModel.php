<?php

namespace Models;

class RoleModel
{
    function __construct(private $mysql)
    {
    }

    function findAll()
    {
        $query = 'SELECT * FROM roles';
        return $this->mysql->getArrayData($query);
    }
}
