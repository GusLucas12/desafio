<?php
//Cabeçalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");


require_once './model/conexao.php';
require_once './model/cidadao.php';
require_once './controllers/cidadaoController.php';

//instanciando os models
$conexao = new conexao();
$banco = $banco->getConnection();

$cidadaoController = new CidadaoController($banco);

//recebendo dados e decodificando o json
$response_json =file_get_contents("php://input");
$dados=json_decode($response_json,true);

//se receber dados realiza a inserção
if($dados){
    $cidadaoController->cadastrar($dados);
}else{
    $response=[
        "erro"=>true,
        "mensagem"=>"Não foi possivel Cadastrar o Cidadao!"
    ];
}

//retorna a mensagem
http_response_code(200);

echo json_encode($response);
