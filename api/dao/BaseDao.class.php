<?php
require_once dirname(__FILE__)."/../config.php";
class BaseDao{
  protected $connection;



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
    $query="INSERT INTO ".$table." (";
    foreach($entity as $key=>$value){
      $query.=$key.", ";
    }
    $query=substr($query,0,-2);
    $query.=") VALUES (";
    foreach ($entity as $key => $value) {
      $query.=":".$key.", ";
    }
    $query=substr($query,0,-2);
    $query.=")";


    $stmt=$this->connection->prepare($query);
    $stmt->execute($entity);

    return $entity;
  }


  protected function update($table, $updates, $id,$id_column="id"){
    $query="UPDATE ".$table." SET ";
    foreach ($updates as $key => $value) {
      $query.=$key."=:".$key.", ";
    }
    $query=substr($query,0,-2);
    $query.=" WHERE ".$id_column."=:id";

    $stmt=$this->connection->prepare($query);
    $updates["id"]=$id;
    $stmt->execute($updates);



  }

  protected function query($query,$params){
    $stmt=$this->connection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function query_single($query,$params){
    $results=$this->query($query,$params);
    return reset($results);
  }

  


}
 ?>
