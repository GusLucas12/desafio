import React,{useEffect,useState} from "react";

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
            <h1>Listar</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Nis</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {Object.values(data).map(cidadao=> (
                        <tr key={cidadao.id}>
                            <td>{cidadao.id}</td>
                            <td>{cidadao.nome}</td>
                            <td>{cidadao.nis}</td>
                            <td>Vizualizar Editar Apagar</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}

export default Listar;