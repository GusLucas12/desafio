<?php
//Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//incluir conexão
include_once 'conexao.php';

//query no banco de dados
$query_cidadoes="SELECT id,nome,nis FROM cidadao ORDER BY id DESC";
$result_cidadoes = $conn->prepare($query_cidadoes);
$result_cidadoes -> execute();

//listar os cidadoes por coluna 
if(($result_cidadoes)AND ($result_cidadoes->rowCount()!=0)){
    while($row_cidadao=$result_cidadoes->fetch(PDO::FETCH_ASSOC)){
        extract($row_cidadao);

        $lista_cidadaos["records"][$id]=[
            'id'=>$id,
            'nome'=>$nome,
            'nis'=>$nis
        ];
    }

    //resposta com status 200
    http_response_code(200);

    //retornar em formato json
    echo json_encode($lista_cidadaos);
}