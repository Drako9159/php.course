<?php
class ControllerClients
{

    public function create($data)
    {
        if (isset($data["name"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $data["name"])) {
            $json = array("detail" => "error name, only strings");
            echo json_encode($json, true);
            return;
        }
        if (isset($data["lastName"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $data["name"])) {
            $json = array("detail" => "error lastName, only strings");
            echo json_encode($json, true);
            return;
        }
        if (isset($data["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]*([.][a-zA-Z0-9_])*[@][a-zA-Z0-9_]+([-][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["email"])) {
            $json = array("detail" => "error email, only mail");
            echo json_encode($json, true);
            return;
        }

        $clients = ModelClients::index("clients");
        foreach ($clients as $key => $value) {
            if ($value["email"] == $data["email"]) {
                $json = array("detail" => "email is registered");
                echo json_encode($json, true);
                return;
            }
        }

        $id_client_secret = str_replace("$", "c", crypt($data["name"] . $data["lastName"] . $data["email"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));

        $secret_key = str_replace("$", "c", crypt($data["email"] . $data["lastName"] . $data["name"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));

        $data = array("name" => $data["name"], "lastName" => $data["lastName"], "email" => $data["email"], "id_client_secret" => $id_client_secret, "secret_key" => $secret_key, "updated_at" => date("Y-m-d h:i:s"), "created_at" => date("Y-m-d h:i:s"));

        $create = ModelClients::create("clients", $data);


        if ($create == "ok") {
            $json = array("detail" => "client created");
            echo json_encode($json, true);
            return;
        }
    }
}
