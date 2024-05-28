<?php
//Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//chama os models e controllers
require_once './model/conexao.php';
require_once './model/cidadao.php';
require_once './controllers/cidadaoController.php';

//Instanciamos os modelos
$conexao = new conexao();
$banco = $conexao->getConnection();

$cidadaoController = new CidadaoController($banco);
if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    //listar os cidadoes por nis
    $cidadaoController->buscarPorNIS($nis);
} else {
    //listar os cidadoes por coluna 
    $cidadaoController->listar();
}


