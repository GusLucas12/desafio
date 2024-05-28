<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");

include_once './model/conexao.php';
include_once './model/cidadao.php';
include_once './controllers/cidadaoController.php';

$database = new Conexao();
$db = $database->getConnection();

$cidadaoController = new CidadaoController($db);

$response_json = file_get_contents("php://input");


if (isset($_GET['id'])) {
    $id =htmlspecialchars(strip_tags($_GET['id']));
    $response = $cidadaoController->deletePorId($id);
} else {
    $response = [
        "erro" => true,
        "mensagem" => "Não foi possível deletar o cidadão."
    ];
}

http_response_code(200);
echo json_encode($response);