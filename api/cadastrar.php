<?php
//Cabeçalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");

//incluir conexão
include_once 'conexao.php';

//recebendo dados e decodificando o json
$response_json =file_get_contents("php://input");
$dados=json_decode($response_json,true);

//se receber dados realiza a inserção
if($dados){
    $query_cidadao = "INSERT INTO cidadao(nome,nis) VALUES (:nome,:nis)";
    $cad_cidadao=$conn->prepare($query_cidadao);

    $cad_cidadao->bindParam(':nome',$dados['cidadao']['nome'],PDO::PARAM_STR);
    $cad_cidadao->bindParam(':nis',$dados['cidadao']['nis'],PDO::PARAM_STR);

    $cad_cidadao->execute();
    //analisa se a inserção foi possivel
    if($cad_cidadao->rowCount()){
        $response=[
            "erro"=>false,
            "mensagem"=>"Cidadao Cadastrado com sucesso!"
        ];
    }else{
        $response=[
            "erro"=>true,
            "mensagem"=>"Não foi possivel Cadastrar o Cidadao!"
        ];
    }
}else{
    $response=[
        "erro"=>true,
        "mensagem"=>"Não foi possivel Cadastrar o Cidadao!"
    ];
}

//retorna a mensagem
http_response_code(200);

echo json_encode($response);
