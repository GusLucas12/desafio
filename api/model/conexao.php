<?php

class conexao{
  private  $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $dbname = "desafio";
  private $port = "3306";

  private $conn;

  public function getConnection(){
    $this-> conn = null;
    try{
        $this->conn=new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname,$this->user,$this->pass); 
        $this->conn->exec("set names utf8");
    } catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }
    
    return $this-> conn ;
  }
}

