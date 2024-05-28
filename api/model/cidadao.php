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
    public function buscar($nis)
    {
        $query_nis = "SELECT id,nome,nis FROM cidadao WHERE nis= :nis ";
        $result_cidadoes = $this->conn->prepare($query_nis);
        $result_cidadoes->bindParam(":nis", $nis);
        $result_cidadoes->execute();
        return $result_cidadoes;
    }
    public function criar()
    {   
        //garente que nome não pode ser nulo
        if (empty($this->nome)) {
            return array("erro" => true, "mensagem" => "Nome não pode ser nulo.");
        }
        //gera o nis automaticamente
        $this->nis = $this->geradorNis();

        //faz a inserção dentro do banco de dados;
        $query_cidadao = "INSERT INTO cidadao(nome,nis) VALUES (:nome,:nis)";
        $cad_cidadao = $this->conn->prepare($query_cidadao);

         

        $cad_cidadao->bindParam(':nome', $this->nome);
        $cad_cidadao->bindParam(':nis', $this->nis);

        if ($cad_cidadao->execute()) {
            return true;
        }
        return false;
    }

    private function geradorNis()
    {
        $nis = '';
        do {
            for ($i = 0; $i < 11; $i++) {
                $nis .= mt_rand(0, 9);
            }

            //compara se existe um Nis igual ao gerado
            $query = "SELECT id FROM  cidadao WHERE nis = :nis";
            $nisComparador = $this->conn->prepare($query);
            $nisComparador->bindParam(':nis', $nis);
            $nisComparador->execute();
        } while ($nisComparador->rowCount() > 0);
        return $nis;
    }
}