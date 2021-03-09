<?php
require_once dirname(__FILE__)."/../config.php";
class BaseDao{
  private $connection;



  public function __construct(){


    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEMA, Config::DB_USERNAME, Config::DB_PASSWORD);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "CONNECTED";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    
  }

  public function insert(){

  }

  public function update(){

  }

  public function query(){

  }

  public function query_single(){

  }


}
 ?>
