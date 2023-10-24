<?php

$arrayRoutes = explode("/", $_SERVER["REQUEST_URI"]);
echo "<pre>";
print_r($arrayRoutes);
echo "<pre>";


if (count(array_filter($arrayRoutes)) == 2) {
    $json = array("detail" => "not found");
    echo json_encode($json, true);
    return;
} else {
    if (count(array_filter($arrayRoutes)) == 3) {
        if (array_filter($arrayRoutes)[3] == "courses") {
            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = array("title" => $_POST["title"], "description" => $_POST["description"], "instructor" => $_POST["instructor"], "image" => $_POST["image"], "price" => $_POST["price"]);
                $courses = new ControllerCourses();
                $courses->create($data);
            } else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
                $courses = new ControllerCourses();
                $courses->index();
            }
        }
        if (array_filter($arrayRoutes)[3] == "register") {
            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = array("name" => $_POST["name"], "lastName" => $_POST["lastName"], "email" => $_POST["email"]);
                $clients = new ControllerClients();
                $clients->create($data);
            }
        }
    } else {
        if (array_filter($arrayRoutes)[3] == "courses" && is_numeric(array_filter($arrayRoutes)[4])) {
            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
                $courses = new ControllerCourses();
                $courses->show(array_filter($arrayRoutes)[4]);
            }
            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") {
                $courses = new ControllerCourses();
                $courses->update(array_filter($arrayRoutes)[4]);
            }
            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") {
                $courses = new ControllerCourses();
                $courses->delete(array_filter($arrayRoutes)[4]);
            }
        }
    }
}
