import React, { useEffect, useState } from "react";
function Cadastrar() {
    const [cidadao, setCidadao] = useState({
        nome: ''
    });
    const [status, setStatus] = useState({
        type: '',
        mensagem: ''
    });
    const valorInput = e => setCidadao({ ...cidadao, [e.target.name]: e.target.value });

    //funcao que gera o NIS automaticamente
  

    const cadCidadao = async e => {
        e.preventDefault();
        console.log(cidadao.nome);

        await fetch("http://localhost/desafio/cadastrar.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cidadao })
        })
            .then((response) => response.json())
            .then((responseJson) => {//console.log(responseJson)
                if (responseJson.erro) {
                    setStatus({
                        type: 'erro',
                        mensagem: responseJson.mensagem
                    });
                } else {
                    setStatus({
                        type: 'sucess',
                        mensagem: responseJson.mensagem
                    });
                }
            })
            .catch(() => { setStatus({ type: 'erro', mensagem: 'Cidadao não Cadastrado com sucesso,tente mais tarde!' }) })
    }


    return (
        <div>
            <h1>Cadastrar</h1>
            {status.type === 'erro' ? <p>{status.mensagem}</p> : " "}
            {status.type === 'sucess' ? <p>{status.mensagem}</p> : " "}
            <form onSubmit={cadCidadao}>
                <label>Nome: </label>
                <input type="text" name="nome" placeholder="Nome do Cidadao" onChange={valorInput} /> <br />

               
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    );
}
export default Cadastrar;