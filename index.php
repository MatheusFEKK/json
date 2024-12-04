<?php
require_once 'models/cliente.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) 
        {
            echo json_encode(Cliente::getWhere($_GET['id'])); // É usado para transformar o PHP em JSON (saída)
        } else 
        {
            echo json_encode(Cliente::getAll());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input')); // É usado para trasnformar JSON em PHP (entrada)

        if ($data != NULL) 
        {
            if (Cliente::insert($data->nome, $data->email))
            {
                http_response_code(200);
            }else 
            {
                http_response_code(400);
            }
        }else 
        {
            http_response_code(405);
        }
        break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'));
            if ($data != NULL)
            {
                if (Cliente::update($data->id, $data->nome, $data->email))
                {
                    http_response_code();
                }else {
                    http_response_code(400);
                }
            }else {
                http_response_code(405);
            }

    default:
        # code...
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="box">
            <h1>LOCALIZAR</h1>
            <form action="index.php" method="get">
                <input type="text" value=""><br>
                <input type="text" name="id" placeholder="ID"><br>
                <button class="btn btn-primary" style="float:right;">ENVIAR</button>
            </form>
        </div>
        <div class="box2">
            <h1>CADASTRO</h1>
            <form action="index.php" method="post">
                <input type="text" name="nome" placeholder="ID"><br>
                <input type="text" name="email" placeholder="ID"><br><br>
                <button class="btn btn-primary" style="float:right;">ENVIAR</button>
            </form>
        </div>
    </div>
</body>

</html>