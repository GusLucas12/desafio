<?php
//Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//incluir conexão
include_once 'conexao.php';

$query_cidadoes="SELECT id,nome,nis FROM cidadao ORDER BY id DESC";
$result_cidadoes = $conn->prepare($query_cidadoes);
$result_cidadoes -> execute();
