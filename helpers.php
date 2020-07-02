<?php

use App\Core\Database;

function database()
{
    $config = require 'config.php';
    return Database::getInstance($config)->connection();
}

function getSingleRow(string $statement, array $parameters)
{
    $result = database()->prepare($statement);
    $result->execute($parameters);
    return $result->fetch();
}

function getAllRows(string $statement, array $parameters)
{
    $result = database()->prepare($statement);
    $result->execute($parameters);
    return $result->fetchAll();
}