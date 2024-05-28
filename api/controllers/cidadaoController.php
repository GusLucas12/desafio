<?php

class CidadaoController
{
    private $cidadao;
    public function __construct($banco)
    {
        $this->cidadao = new Cidadao($banco);
    }
    public function listar()
    {
        $result_cidadoes = $this->cidadao->listar();
        $cidadoes_arr = array();
        $cidadoes_arr["records"] = array();

        while ($row_cidadao = $result_cidadoes->fetch(PDO::FETCH_ASSOC)) {
            extract($row_cidadao);

            $lista_cidadaos=array( 
                'id' => $id,
                'nome' => $nome,
                'nis' => $nis
            );

            array_push($cidadoes_arr["records"],$lista_cidadaos);
        }
        http_response_code(200);
        echo json_encode($cidadoes_arr);
    }

    public function cadastrar($data)
    {
        $this->cidadao->nome = $data['cidadao']['nome'];
        $result = $this->cidadao->criar();
        
        if ($result) {
            $response = [
                "erro" => false,
                "mensagem" => "Cidadao Cadastrado com sucesso!",
                "nis" => $this->cidadao->nis
            ];

           
        } else {
            $response = [
                "erro" => true,
                "mensagem" => "Não foi possivel Cadastrar o Cidadao! "
            ];
        }
        //retorna a mensagem
        http_response_code(200);

        echo json_encode($response);
    }

    public function buscarPorNIS($nis){
        $response = $this->cidadao->buscar($nis);
        if ($response->rowCount()>0) {
            $row = $response->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $cidadao=array(
                "id"=>$id,
                "nome"=>$nome,
                "nis"=>$nis
            );
            http_response_code(200);
            echo json_encode($cidadao);

        }else{
            http_response_code(400);
            echo json_encode(array("mensagem" => "Cidadao não encontrado."));
        }
    }

    public function deletePorId($id){
        $response = $this->cidadao->delete($id);
        if($response){
            $mensagem=["erro"=> false,"mensagem"=> "Deletado com sucesso"];
            

           
        }else{
            $mensagem=["erro"=> true,"mensagem"=> "Não foi possivel deletar! Tente novamente mais tarde"];
            
           
        }
        http_response_code(200);
        echo json_encode($mensagem);
    }    
}