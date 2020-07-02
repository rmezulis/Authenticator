<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $connection;
    private static $instance = null;

    public function __construct(array $config)
    {
        if (self::$instance === null) {
            self::$instance = $this;
        }

        try {
            $this->connection = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance($config)
    {
        return self::$instance ?? new Database($config);
    }

    public function connection()
    {
        return $this->connection;
    }
}