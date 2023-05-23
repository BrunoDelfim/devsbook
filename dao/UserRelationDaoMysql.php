<?php

require_once 'models/UserRelation.php';

class UserRelationDaoMysql implements UserRelationDAO
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function insert(UserRelation $u)
    {

    }

    public function getRelationsFrom($id)
    {
        
    }
}