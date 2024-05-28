import React, { useEffect, useState } from "react";
import Header from "../components/header";
import styles from "./cadastrar.module.css";
function Cadastrar() {
    const [cidadao, setCidadao] = useState({
        nome: ''
    });
    const [status, setStatus] = useState({
        type: '',
        mensagem: '',
        nis:''
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
                        mensagem: responseJson.mensagem,
                        nis: responseJson.nis
                    });
                }
            })
            .catch(() => { setStatus({ type: 'erro', mensagem: 'Cidadao não Cadastrado com sucesso,tente mais tarde!' }) })
    }


    return (
        <div>
            <Header></Header>
            <h1>Cadastrar</h1>
            <div className={styles.pag}>
                <div className={styles.container}>
                    <form onSubmit={cadCidadao}>
                        <label>Nome: </label>
                        <input type="text" name="nome" placeholder="Nome do Cidadao" onChange={valorInput} /> <br />


                        <button type="submit">Cadastrar</button>

                        <div id="nisResult" class="result">
                            {status.type === 'erro' ? <p>{status.mensagem}</p> : " "}
                            {status.type === 'sucess' ? (
                                <div>
                                    <p>{status.mensagem}</p>
                                    <p>NIS Gerado: {status.nis}</p>
                                </div>
                            ) : " "}
                        </div>

                    </form>
                </div>
            </div>




        </div>
    );
}
export default Cadastrar;