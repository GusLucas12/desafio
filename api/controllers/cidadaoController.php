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
        if (($result_cidadoes) and ($result_cidadoes->rowCount() != 0)) {
            while ($row_cidadao = $result_cidadoes->fetch(PDO::FETCH_ASSOC)) {
                extract($row_cidadao);

                $lista_cidadaos["records"][$id] = [
                    'id' => $id,
                    'nome' => $nome,
                    'nis' => $nis
                ];
            }
        }
    }

    public function cadastrar($data)
    {
        $this->cidadao->nome = $data['cidadao']['nome'];
        if ($this->cidadao->criar()) {
            $response = [
                "erro" => false,
                "mensagem" => "Cidadao Cadastrado com sucesso!"
            ];
        } else {
            $response = [
                "erro" => true,
                "mensagem" => "Não foi possivel Cadastrar o Cidadao!"
            ];
        }
        //retorna a mensagem
        http_response_code(200);

        echo json_encode($response);
    }
}