<?php
namespace App\Core;

abstract class Model
{
    protected string $table;

    protected function db(): \PDO
    {
        return Database::connection();
    }
}
