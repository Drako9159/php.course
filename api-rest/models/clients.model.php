<?php

require_once "connection.php";

class ModelClients
{
    static public function index($table)
    {
        $st = Connection::connect()->prepare("SELECT * FROM $table");
        $st->execute();
        return $st->fetchAll();
        $st->close();
        $st = null;
    }


    static public function create($table, $data)
    {

        $st = Connection::connect()->prepare("INSERT INTO $table(name, last_name, email, id_client_secret, secret_key, created_at, updated_at) VALUES (:name, :last_name, :email, :id_client_secret, :secret_key, :created_at, :updated_at)");

        $st->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $st->bindParam(":last_name", $data["lastName"], PDO::PARAM_STR);
        $st->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $st->bindParam(":id_client_secret", $data["id_client_secret"], PDO::PARAM_STR);
        $st->bindParam(":secret_key", $data["secret_key"], PDO::PARAM_STR);
        $st->bindParam(":created_at", $data["created_at"], PDO::PARAM_STR);
        $st->bindParam(":updated_at", $data["updated_at"], PDO::PARAM_STR);

        if ($st->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
        }

        $st->close();
        $st = null;
    }
}
