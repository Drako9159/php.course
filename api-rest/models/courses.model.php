<?php

require_once "connection.php";

class ModelCourses
{
    static public function index($table1, $table2, $amount, $from)
    {
        if ($amount != null) {
            $st = Connection::connect()->prepare("SELECT $table1.id_course, $table1.title, $table1.description, $table1.instructor, $table1.image, $table1.price, $table1.id_creator, $table2.name, $table2.last_name FROM $table1 INNER JOIN $table2 ON $table1.id_creator = $table2.id_client LIMIT $from, $amount");
        } else {
            $st = Connection::connect()->prepare("SELECT $table1.id_course, $table1.title, $table1.description, $table1.instructor, $table1.image, $table1.price, $table1.id_creator, $table2.name, $table2.last_name FROM $table1 INNER JOIN $table2 ON $table1.id_creator = $table2.id_client");
        }
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
        $st->close();
        $st = null;
    }

    static public function create($table, $data)
    {

        $st = Connection::connect()->prepare("INSERT INTO $table(title, description, instructor, image, price, id_creator, created_at, updated_at) VALUES (:title, :description, :instructor, :image, :price, :id_creator, :created_at, :updated_at)");

        $st->bindParam(":title", $data["title"], PDO::PARAM_STR);
        $st->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $st->bindParam(":instructor", $data["instructor"], PDO::PARAM_STR);
        $st->bindParam(":image", $data["image"], PDO::PARAM_STR);
        $st->bindParam(":price", $data["price"], PDO::PARAM_STR);
        $st->bindParam(":id_creator", $data["id_creator"], PDO::PARAM_STR);
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

    static public function show($table1, $table2, $id)
    {
        $st = Connection::connect()->prepare("SELECT $table1.id_course, $table1.title, $table1.description, $table1.instructor, $table1.image, $table1.price, $table1.id_creator, $table2.name, $table2.last_name FROM $table1 INNER JOIN $table2 ON $table1.id_creator = $table2.id_client WHERE $table1.id_course = :id");


        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
        $st->close();
        $st = null;
    }

    static public function update($table, $data)
    {
        $st = Connection::connect()->prepare("UPDATE $table SET title=:title, description=:description, instructor=:instructor, image=:image, price=:price, updated_at=:updated_at WHERE id_course=:id");
        $st->bindParam(":id", $data["id"], PDO::PARAM_STR);
        $st->bindParam(":title", $data["title"], PDO::PARAM_STR);
        $st->bindParam(":description", $data["description"], PDO::PARAM_STR);
        $st->bindParam(":instructor", $data["instructor"], PDO::PARAM_STR);
        $st->bindParam(":image", $data["image"], PDO::PARAM_STR);
        $st->bindParam(":price", $data["price"], PDO::PARAM_STR);
        $st->bindParam(":updated_at", $data["updated_at"], PDO::PARAM_STR);

        if ($st->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
        }

        $st->close();
        $st = null;
    }

    static public function delete($table, $id)
    {
        $st = Connection::connect()->prepare("DELETE FROM $table WHERE id_course=:id");
        $st->bindParam(":id", $id, PDO::PARAM_INT);

        if ($st->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
        }

        $st->close();
        $st = null;
    }
}
