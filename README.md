# Desafio Técnico Gesuas

Este projeto foi proposto para resolução do Desafio Técnico da empresa Gesuas.Consiste em uma aplicação web para cadastro e procura de cidadãos através de um código de 11 caracteres unico por cidadão.

## Introdução

O CidadãoAPP permite o cadastro, listagem e exclusão de registros de cidadãos, onde cada cidadão possui um nome e um NIS (Número de Identificação Social). O NIS é um código de 11 digitos gerado automaticamente no backend e garantido que seja único.

## Tecnologias Utilizadas

- **Backend:** PHP com PDO para interação com o banco de dados MySQL.
- **Frontend:** React.js.
- **Banco de Dados:** MySQL.
- **Servidor Web:** Apache (XAMPP recomendado).
-**Extras:** GitHub(Versionamento),Figma(Projeto de Telas).

## Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:

- [XAMPP](https://www.apachefriends.org/index.html) (ou outro servidor Apache com suporte a PHP e MySQL)
- [Node.js](https://nodejs.org/en/)
- [npm](https://www.npmjs.com/) (gerenciador de pacotes do Node.js)
- [Git](https://git-scm.com/)

## Instalação

### Clonando o Repositório

```bash
git clone https://github.com/GusLucas12/desafio.git
cd desafio
```
### Configurando o Backend
Inicie o servidor Apache e MySQL pelo XAMPP.
Crie o banco de dados:

```sql
CREATE DATABASE desafio;
```
Crie a tabela cidadao:

```sql

USE desafio;

CREATE TABLE cidadao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nis VARCHAR(11) NOT NULL UNIQUE
);
```
Configuração do arquivo conexao.php:
Edite o arquivo conexao.php com as configurações do seu banco de dados (usuário, senha, etc).

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "desafio";
$port = "3306";

$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
?>
```
Copie os arquivos PHP para o diretório raiz do seu servidor Apache (htdocs no XAMPP):
```bash

cp -r api/* /path/to/htdocs/desafio
```
### Configurando o Frontend
Navegue até o diretório frontend:
```bash
cd frontend
```
Instale as dependências:
```bash
npm install
```
Inicie o servidor de desenvolvimento:
```bash
npm start
```
### Uso
Acesse o backend no navegador:
```plaintext
http://localhost/desafio
```
Acesse o frontend no navegador:
```plaintext
http://localhost:3000
```
## Funcionalidades
Cadastro de Cidadãos: Adicione o nome de um cidadão e o NIS será gerado automaticamente.
Listagem de Cidadãos: Veja todos os cidadãos cadastrados com a opção de deletar cada um deles.
Deleção de Cidadãos: Remova um cidadão da lista ao clicar no botão "Apagar".

## Estrutura do Projeto
```plaintext
desafio/
├── api/
|   ├── model/
|   |   ├──cidadao.php
|   |   └──conexao.php 
|   ├── views/
|   |   ├──deletar.php
|   |   └──cadastrar.php
│   ├── index.php
│   └── controllers/
│       └── cidadaoController.php
└── frontend/
    ├── public/
    ├── src/
    │   ├── components/
    |   |   ├── nav.module.css
    │   │   └── Header.js
    │   ├── pages/
    |   |   ├── listar.module.css 
    |   |   ├── Home.module.css
    |   |   ├── cadastrar.module.css    
    |   |   ├── Home.js     
    │   │   ├── cadastrar.js
    │   │   └── listar.js
    │   ├── App.js
    │   └── index.js
    ├── .gitignore
    ├── package.json
    └── README.md
```    
Contato

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para entrar em contato:

Email: gustavosilveira422.gl@gmail.com
LinkedIn: https://www.linkedin.com/in/gustavo-lucas-7b44aa231/


Feito por Gustavo Silveira Lucas
