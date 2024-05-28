import React, { useEffect, useState } from "react";
import Header from "../components/header";
import deletar from "../images/images.png";
import styles from "./listar.module.css";
import lupa from "../images/lupa.png";

function Listar() {
    const [data, setData] = useState([]);
    const [searchNIS, setSearchNIS] = useState("");
    const getCidadoes = async (nis = "") => {
        let url = "http://localhost/desafio/index.php";
        if (nis) {

            url += `?nis=${nis}`;
            console.log(url);
        }

        fetch(url)
            .then((response) => response.json())
            .then((responseJson) => {
                if (responseJson.records) {
                    setData(responseJson.records);
                } else if (responseJson.id) {
                    setData([responseJson]);
                } else {
                    setData([]);
                }
            });
    };
    const deleteCidadao = async (id) => {
        fetch(`http://localhost/desafio/delete.php?id=${id}`)
            .then((response) => response.json())
            .then((responseJson) => {
                if (responseJson.erro) {
                    setData({
                        type: 'erro',
                        mensagem: responseJson.mensagem
                    });
                } else {
                    setData({
                        type: 'sucess',
                        mensagem: responseJson.mensagem
                    });
                
                }
            })
            .catch(() => {
                setData({ type: 'erro', mensagem: 'Erro ao deletar cidadão, tente mais tarde!' });
            });
            window.location.reload();
    };
    const handleSearchChange = (e) => {
        setSearchNIS(e.target.value);
        console.log(e.target.value);
    };

    const handleSearchSubmit = (e) => {
        e.preventDefault();
        getCidadoes(searchNIS);
    };
    

    useEffect(() => {
        getCidadoes();
    }, []);

    return (
        <div>
            <Header></Header>
            <div className={styles}>

                <h1>Cidadões Cadastrados:</h1>
                <div className={styles.pag}>

                    <div className={styles.tabela}>
                        <div className={styles.pag}>
                            <div className={styles.search}>
                                <div className={styles.container}>
                                    <form onSubmit={handleSearchSubmit} className={styles.searchform}>
                                        <input type="text" name="nis" placeholder="Procura por NIS"
                                            value={searchNIS} onChange={handleSearchChange} /> <br />
                                        <button type="submit">
                                            <img src={lupa} className={styles.searchicon}></img>
                                        </button>

                                    </form>
                                </div>
                            </div>
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
                                {data.length > 0 ? (
                                    Object.values(data).map(cidadao => (
                                        <tr key={cidadao.id}>
                                            <td><div className={styles.exibition}>{cidadao.nome}</div></td>
                                            <td><div className={styles.exibition}>{cidadao.nis}</div></td>
                                            <td><button onClick={()=> deleteCidadao(cidadao.id)} >
                                                    <img src={deletar} className={styles.deleteicon}></img>
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="3">Nenhum cidadão encontrado</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>


                </div>


            </div>
        </div>
    )
}


export default Listar;