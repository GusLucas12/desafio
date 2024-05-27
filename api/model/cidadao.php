<?php

class Cidadao
{
    //definicoes 
    private $conn;
    private $tabela;

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
    public function buscar($id){
        
    }
    public function criar(){
        $this->nis= $this->geradorNis();

        $query_cidadao = "INSERT INTO cidadao(nome,nis) VALUES (:nome,:nis)";
        $cad_cidadao=$this->conn->prepare($query_cidadao);
        
        $this->nome = htmlspecialchars(strip_tags(($this->nome)));

        $cad_cidadao->bindParam(':nome',$this->nome);
        $cad_cidadao->bindParam(':nis',$this->nis);
        
        if($cad_cidadao->execute()){
            return true;
        }
        return false;
    }

    private function geradorNis(){
        $nis='';
        for($i=0;$i<11;$i++){
            $nis .=mt_rand(0,9);
        }
        return $nis;
    }
}