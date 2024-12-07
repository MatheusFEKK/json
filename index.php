<?php
require_once 'models/cliente.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) 
        {
            echo json_encode(Cliente::getWhere($_GET['id'])); // É usado para transformar o PHP em JSON (saída)
        } else 
        {
            $json = json_encode(Cliente::getAll());
            
        }
        break;

    case 'POST':
        // $data = json_decode(file_get_contents('php://input')); // É usado para trasnformar JSON em PHP (entrada)
        if (isset($_POST['email']) && isset($_POST['nome'])) 
        {
            if (Cliente::insert($_POST['nome'], $_POST['email']))
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

        case 'DELETE':
            $data = json_decode(file_get_contents('php://input'));
            if ($data != NULL)
            {
                if (Cliente::delete($data->id))
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
    <div class="container d-flex justify-content-center">
        <div class="box ">
            <h1>LOCALIZAR</h1>
            <form action="index.php" method="get">
                <input type="text" value=""><br>
                <input type="text" name="id" placeholder="ID"><br>
                <button class="btn btn-primary float-end">ENVIAR</button>
            </form>
        </div>
            <div class="p-5"></div>
        <div class="box2">
            <h1>CADASTRO</h1>
            <form action="" method="POST">
                <input type="text" name="nome" placeholder="NOME"><br>
                <input type="text" name="email" placeholder="EMAIL"><br>
                <button class="btn btn-primary float-end">ENVIAR</button>
            </form>
        </div>
        </div>
       
       <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">MODIFICAR</th>
    </tr>
  </thead>
  <tbody>
  <?php 
            foreach ($jsondecode = json_decode($json) as $users){
                echo "<tr>
                <th scope='row'>$users->id</th>
                <td>$users->nome</td>
                <td>$users->email</td>
                <td><a class='btn btn-primary' href='?id=$users->id'>EDITAR</a>
                <a class='btn btn-danger' href='?delete=$users->id'>DELETAR</a>
                </tr>";
            }
            ?>
  </tbody>
</table>
    </div>
</body>
</html>