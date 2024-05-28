import React, { useEffect, useState } from "react";
import Header from "../components/header";
import styles from "./listar.module.css"
import lupa from "../images/lupa.png";
function Listar() {
    const [data, setData] = useState([]);
    const getCidadoes = async () => {
        fetch("http://localhost/desafio/index.php")
            .then((response) => response.json())
            .then((responseJson) => (setData(responseJson.records)));
    }
    useEffect(() => {
        getCidadoes();
    }, [])

    return (
        <div>
            <Header></Header>
            <div className={styles}>

                <h1>Cidadões Cadastrados:</h1>
                <div className={styles.pag}>

                    <div className={styles.tabela}>
                        <div className={styles.search} >

                            <input type="text" name="nome" placeholder="Procura por NIS" /> <br />
                            <img src={lupa} class="search-icon"></img>


                        </div>

                        <table>
                            <thead>
                                <tr>

                                    <th><h1>Nome</h1></th>
                                    <th><h1>NIS</h1></th>

                                </tr>
                            </thead>
                            <tr>
                                <td> <div className={styles.line}></div>
                                </td>
                                <td> <div className={styles.line}></div>
                                </td>
                                <td> <div className={styles.line}></div>
                            </td>
                            </tr>
                            <tbody>
                                {Object.values(data).map(cidadao => (
                                    <tr key={cidadao.id}>

                                        <td><div className={styles.exibition}>{cidadao.nome}</div></td>
                                        <td><div className={styles.exibition}>{cidadao.nis}</div></td>
                                        <td> Apagar</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>


                </div>


            </div>
        </div>
    )
}

export default Listar;