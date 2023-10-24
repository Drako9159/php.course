<?php
class ControllerCourses
{

    public function index()
    {
        $clients = ModelClients::index("clients");


        if (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {

            foreach ($clients as $key => $value) {
                if (base64_encode($_SERVER["PHP_AUTH_USER"] . ":" . $_SERVER["PHP_AUTH_PW"]) == base64_encode($value["id_client_secret"] . ":" . $value["secret_key"])) {
                    $courses = ModelCourses::index("courses");
                    $json = array("detail" => $courses);
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
                    $courses = ModelCourses::index("courses");
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
        $json = array("detail" => "list course show " . $id);
        echo json_encode($json, true);
        return;
    }

    public function update($id)
    {
        $json = array("detail" => "list course updated " . $id);
        echo json_encode($json, true);
        return;
    }

    public function delete($id)
    {
        $json = array("detail" => "list course deleted " . $id);
        echo json_encode($json, true);
        return;
    }
}
