<?php

class Connection
{
    static public function connect()
    {
        $link = new PDO("mysql:host=localhost;dbname=api_rest_php_db;", "drako", "password");
        $link->exec("set names utf8");
        return $link;
    }
}
