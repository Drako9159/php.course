<?php
class ControllerCourses
{

    public function index($page)
    {
        $clients = ModelClients::index("clients");
        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
            foreach ($clients as $key => $value) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($value["id_client_secret"] . ":" . $value["secret_key"])) {

                    if ($page != null) {
                        $amount = 10;
                        $from = ($page - 1) * $amount;
                        $courses = ModelCourses::index("courses", "clients", $amount, $from);
                    } else {
                        $courses = ModelCourses::index("courses", "clients", null, null);
                    }

                    $json = array("status" => 200, "total_register" => count($courses), "detail" => $courses);
                    echo json_encode($json, true);
                    return;
                }
            }
        }
    }

    public function create($data)
    {
        $clients = ModelClients::index("clients");

        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {

            foreach ($clients as $key => $valueClient) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($valueClient["id_client_secret"] . ":" . $valueClient["secret_key"])) {
                    foreach ($data as $key => $valueData) {
                        if (isset($valueData) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueData)) {
                            $json = array("status" => 404, "detail" => "Error in: " . $key);
                            echo json_encode($json, true);
                            return;
                        }
                    }

                    $courses = ModelCourses::index("courses", "clients", null, null);
                    foreach ($courses as $key => $value) {
                        if ($value->title == $data["title"]) {
                            $json = array("status" => 404, "detail" => "title is already in database");
                            echo json_encode($json, true);
                            return;
                        }
                        if ($value->description == $data["description"]) {
                            $json = array("status" => 404, "detail" => "description is already in database");
                            echo json_encode($json, true);
                            return;
                        }
                    }

                    $data = array(
                        "title" => $data["title"],
                        "description" => $data["description"],
                        "instructor" => $data["instructor"],
                        "image" => $data["image"],
                        "price" => $data["price"],
                        "id_creator" => $valueClient["id_client"],
                        "created_at" => date("Y-m-d h:i:s"),
                        "updated_at" => date("Y-m-d h:i:s")
                    );

                    $create = ModelCourses::create("courses", $data);

                    if ($create == "ok") {
                        $json = array("detail" => "course created");
                        echo json_encode($json, true);
                        return;
                    }
                }
            }
        }


        $json = array("detail" => "please auth");
        echo json_encode($json, true);
        return;
    }

    public function show($id)
    {

        $clients = ModelClients::index("clients");

        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
            foreach ($clients as $key => $valueClient) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($valueClient["id_client_secret"] . ":" . $valueClient["secret_key"])) {
                    $course = ModelCourses::show("courses", "clients", $id);
                    if (!empty($course)) {
                        $json = array("status" => 200, "detail" => $course);
                        echo json_encode($json, true);
                        return;
                    } else {
                        $json = array("status" => 404, "detail" => "course not found");
                        echo json_encode($json, true);
                        return;
                    }
                }
            }
        }


        $json = array("detail" => "please auth");
        echo json_encode($json, true);
        return;
    }

    public function update($id, $data)
    {
        $clients = ModelClients::index("clients");

        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
            foreach ($clients as $key => $valueClient) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($valueClient["id_client_secret"] . ":" . $valueClient["secret_key"])) {
                    foreach ($data as $key => $valueData) {
                        if (isset($valueData) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueData)) {
                            $json = array("status" => 404, "detail" => "Error in: " . $key);
                            echo json_encode($json, true);
                            return;
                        }
                    }

                    $course = ModelCourses::show("courses", "clients", $id);
                    if (!$course) {
                        $json = array("status" => 404, "detail" => "course not found");
                        echo json_encode($json, true);
                        return;
                    }
                    foreach ($course as $key => $valueCourse) {
                        if ($valueCourse->id_creator == $valueClient["id_client"]) {
                            $data = array(
                                "id" => $id,
                                "title" => $data["title"],
                                "description" => $data["description"],
                                "instructor" => $data["instructor"],
                                "image" => $data["image"],
                                "price" => $data["price"],
                                "updated_at" => date("Y-m-d h:i:s")
                            );
                            $update = ModelCourses::update("courses", $data);
                            if ($update == "ok") {
                                $json = array("detail" => "course updated");
                                echo json_encode($json, true);
                                return;
                            }
                        }
                    }
                }
            }
        }


        $json = array("detail" => "please auth");
        echo json_encode($json, true);
        return;
    }

    public function delete($id)
    {
        $clients = ModelClients::index("clients");

        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
            foreach ($clients as $key => $valueClient) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($valueClient["id_client_secret"] . ":" . $valueClient["secret_key"])) {
                    $course = ModelCourses::show("courses", "clients", $id);
                    if (!$course) {
                        $json = array("status" => 404, "detail" => "course not found");
                        echo json_encode($json, true);
                        return;
                    }
                    foreach ($course as $key => $valueCourse) {
                        if ($valueCourse->id_creator == $valueClient["id_client"]) {
                            $delete = ModelCourses::delete("courses", $id);
                            if ($delete == "ok") {
                                $json = array("detail" => "course deleted");
                                echo json_encode($json, true);
                                return;
                            }
                        }
                    }
                }
            }
        }


        $json = array("detail" => "please auth");
        echo json_encode($json, true);
        return;
    }
}
