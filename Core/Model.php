<?php

namespace Core;

use App\Config;
use PDO;


class Model
{
    protected static function getDB()
    {
        static $db = null;
        if ($db === null) {
            $host     = Config::DB_HOST;
            $dbname   = Config::DB_NAME;
            $username = Config::DB_USER;
            $password = Config::DB_PASS;

            try {

                $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $db;
    }
}