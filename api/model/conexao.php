<?php

class conexao{
  private  $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $dbname = "desafio";
  private $port = "3306";

  private $conn;

  public function getConnection(){
    return $this->conn=new PDO("mysql:host=$this->host;port=$this->port;dbname=".$this->dbname,$this->user,$this->pass);    
  }
}

