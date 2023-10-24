<?php

$value="";
$from="";
$to="";

function convert_from_metros($value, $unity){
    switch($unity){
        case "Milimetro": 
            return $value / 1000;
            break;
        case "Centimetro":
            return $value / 100;
            break;
        case "Decimetro":
            return $value / 10;
            break;
        case "Metro":
            return $value * 1;
            break;
        case "Decametro":
            return $value * 10;
            break;
        case "Hectometro":
            return $value * 100;
            break;
        case "Kilometro":
            return $value * 1000;
            break;
        default: return "Unity unsupported";
        break;
    }
}

function convert_to_metros($value, $unity){
    switch($unity){
        case "Milimetro": 
            return $value * 1000;
            break;
        case "Centimetro":
            return $value * 100;
            break;
        case "Decimetro":
            return $value * 10;
            break;
        case "Metro":
            return $value * 1;
            break;
        case "Decametro":
            return $value / 10;
            break;
        case "Hectometro":
            return $value / 100;
            break;
        case "Kilometro":
            return $value / 1000;
            break;
        default: return "Unity unsupported";
        break;
    }
}


if(isset($_POST["convert"])){
    $value = $_POST["value"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $resultFrom = convert_from_metros($value, $from);
    $resultTo = convert_to_metros($resultFrom, $to);
    $result = $resultTo;
    
}   


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Converter</h1>
    <div class="container">
        <form method="POST">
            <div class="row mt-4">

                <div class="col-sm-4">
                    <div>
                        <label for="value" class="form-label">Value:</label>
                        <input type="number" name="value" class="form-control" value="">
                    </div>
                </div>

                <div class="col-sm-4">
                    <label for="from" class="form-label">From: </label>
                    <select class="form-select" name="from">
                        <option value="">--Select a value--</option>
                        <option value="Milimetro">Milimetro</option>
                        <option value="Centimetro">Centimetro</option>
                        <option value="Decimetro">Decimetro</option>
                        <option value="Metro">Metro</option>
                        <option value="Decametro">Decametro</option>
                        <option value="Hectometro">Hectometro</option>
                        <option value="Kilometro">Kilometro</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="to" class="form-label">To: </label>
                    <select class="form-select" name="to">
                        <option value="">--Select a value--</option>
                        <option value="Milimetro">Milimetro</option>
                        <option value="Centimetro">Centimetro</option>
                        <option value="Decimetro">Decimetro</option>
                        <option value="Metro">Metro</option>
                        <option value="Decametro">Decametro</option>
                        <option value="Hectometro">Hectometro</option>
                        <option value="Kilometro">Kilometro</option>
                    </select>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-6">
                        <button type="submit" name="convert" class="btn btn-primary w-100 py-4">CONVERT</button>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="result" class="form-label">RESULT</label>
                            <input type="text" class="form-control" name="result" value="<?php if(isset($result)) echo $result;?>">
                        </div>
                    </div>
                </div>




            </div>
        </form>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>