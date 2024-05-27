<?php

class Cidadao
{
    //definicoes 
    private $conn;

    public $id;
    public $nome;
    public $nis;

    //construtor
    public function __construct($banco)
    {
        $this->conn = $banco;
    }
    //função para listar os cidadãos 
    public function listar()
    {
        $query_cidadoes = "SELECT id,nome,nis FROM cidadao ORDER BY id DESC";
        $result_cidadoes = $this->conn->prepare($query_cidadoes);
        $result_cidadoes->execute();
        return $result_cidadoes;
    }

    public function criar(){
        $this->nis= $this->geradorNis();

        $query_cidadao = "INSERT INTO cidadao(nome,nis) VALUES (:nome,:nis)";
        $cad_cidadao=$this->conn->prepare($query_cidadao);
        

        $cad_cidadao->bindParam(':nome',$this->nome,PDO::PARAM_STR);
        $cad_cidadao->bindParam(':nis',$this->nis,PDO::PARAM_STR);
    
        $cad_cidadao->execute();
    }

    private function geradorNis(){
        $nis='';
        for($i=0;$i<11;$i++){
            $nis .=mt_rand(0,9);
        }
        return $nis;
    }
}