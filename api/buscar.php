<?php

// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once './model/conexao.php';
require_once './model/cidadao.php';
require_once './controllers/cidadaoController.php';

// Instância de banco de dados e cidadão
$database = new Conexao();
$db = $database->getConnection();

$cidadaoController = new CidadaoController($db);

// Verificar se o NIS foi passado na URL
if(isset($_GET['nis'])) {
    $nis = htmlspecialchars(strip_tags($_GET['nis']));
    $cidadaoController->buscarPorNIS($nis);
} else {
    http_response_code(400);
    echo json_encode(array("mensagem" => "NIS não fornecido."));
}
?>