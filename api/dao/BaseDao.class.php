<?php
require_once dirname(__FILE__)."/../config.php";
class BaseDao{
  private $connection;



  public function __construct(){


    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEMA, Config::DB_USERNAME, Config::DB_PASSWORD);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
      throw $e;
    }


  }

  protected function insert($table, $entity){
    $query = 'INSERT INTO '.$table.' (';
    foreach($entity as $key=>$value){
      $query.=$key.", ";
    }
    $query=substr($query,0,-2);
    $query.=") VALUES (";
    foreach($entity as $key=>$value){
      $query.=":".$key;
    }
    $query=substr($query,0,-2);
    $query.=")";



    $s=this->connection->prepare($query);
    $s->execute($entity);
    $entity['id']=$this->connection->lastInsertId();
    return $entity;
  }


  protected function update(){

  }

  protected function query($query,$params){
    $stmt=$this->connection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function query_single($query,$params){
    $results = $this->query($query,$params);
    return reset($results);
  }


}
 ?>
