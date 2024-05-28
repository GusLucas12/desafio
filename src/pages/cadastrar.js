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
        nis: ''
    });
    const valorInput = e => setCidadao({ ...cidadao, [e.target.name]: e.target.value });



    const cadCidadao = async e => {
        e.preventDefault();
        await fetch("http://localhost/desafio/views/cadastrar.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cidadao })
        }).then((response) => response.json())
            .then((responseJson) => {
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
            .catch(() => {
                setStatus({ type: 'erro', mensagem: 'Cidadao não Cadastrado com sucesso, tente mais tarde!' })
            });
    }


    return (
        <div>
            <Header></Header>
            <h1>Cadastrar</h1>
            <div className={styles.pag}>
                <div className={styles.container}>
                    <form onSubmit={cadCidadao}>
                        <label><h1>Nome:</h1> </label>
                        <input type="text" name="nome" placeholder="Nome do Cidadao" onChange={valorInput} /> <br />


                        <button type="submit">Cadastrar</button>

                        <div className={styles.nisResult}>
                            <h1>Mensagem de Cadastro:</h1>
                            <div className={styles.nisMensagem}>
                                {status.type === 'erro' ? <p>{status.mensagem}</p> : " "}
                                {status.type === 'sucess' ? (
                                    <div>
                                        <p>{status.mensagem}</p>
                                        <p>NIS Gerado: {status.nis}</p>
                                    </div>
                                ) : " "}
                            </div> 



                        </div>



                    </form>
                </div>
            </div>




        </div>
    );
}
export default Cadastrar;