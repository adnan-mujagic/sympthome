<?php
require_once dirname(__FILE__)."/../config.php";
class BaseDao{
  protected $connection;

  private $table;


  public function __construct($table){
    $this->table=$table;

    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST().";dbname=".Config::DB_SCHEMA(), Config::DB_USERNAME(), Config::DB_PASSWORD());
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    } catch(PDOException $e) {
      throw $e;
    }


  }

  public function beginTransaction(){
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
    $this->connection->beginTransaction();
  }

  public function commit(){
    $this->connection->commit();
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
  }

  public function rollback(){
    $this->connection->rollback();
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
  }

  public static function parse_order($order){
    $column=substr($order,1);
    switch(substr($order,0,1)){
      case "-":
        $direction="ASC";
        break;
      case "+":
        $direction="DESC";
        break;
      default:throw new Exception("Invalid order parameter, you should use + (descending) or - (ascending) as first character to indicate the direction.");
        break;
    }
    return [$column, $direction];
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

    $entity['id'] = $this->connection->lastInsertId();
    return $entity;
  }


  protected function execute_update($table, $updates, $id,$id_column="id"){
    $query="UPDATE ".$table." SET ";
    foreach ($updates as $key => $value) {
      $query.=$key."=:".$key.", ";
    }
    $query=substr($query,0,-2);
    $query.=" WHERE ".$id_column."=:id";

    $stmt=$this->connection->prepare($query);
    $updates["id"]=$id;
    $stmt->execute($updates);
    return $updates;
  }

  public function query($query,$params){
    $stmt=$this->connection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function query_single($query,$params){
    $results=$this->query($query,$params);
    return reset($results);
  }

  public function add($entity){
    try {
      return $this->insert($this->table, $entity);
    } catch (\Exception $e) {
      //HERE WE CAN HANDLE VARIOUS COMMON ERRORS SO THAT WE CAN RETURN A NOT SO CREEPY MESSAGE TO THE USER
      if(str_contains($e->getMessage(),'fk_diseases_disease_category_id')){
        throw new Exception("The disease category does not exist",400,$e);
      }
      else if(str_contains($e->getMessage(),"doesn't have a default value")){
        throw new Exception("You are missing one or more of the required fields",400,$e);
      }
      else{
        throw $e;
      }
    }


  }

  public function update($updates, $id){
    return $this->execute_update($this->table, $updates, $id);
  }

  public function get_by_id($id){
    return $this->query_single("SELECT * FROM ".$this->table." WHERE id=:id",["id"=>$id]);
  }

  public function get_all($offset = 0, $limit = 25, $order="-id"){

    list($column, $direction) = self::parse_order($order);

    $sql = "SELECT * FROM ".$this->table." ORDER BY ".$column." ".$direction." LIMIT ".$limit." OFFSET ".$offset;
    print_r($sql);

    return $this->query($sql,[]);

  }

  //A GLOBAL FUNCTION TO SEARCH FOR ANY ENTITY AS LONG AS YOU ONLY HAVE TO SEARCH IN ONE COLUMN
  public function get_entity_by_search($search,$offset,$limit,$order,$search_column="name"){
    list($column,$direction) = self::parse_order($order);

    $query = "SELECT * FROM ".$this->table." WHERE LOWER(".$search_column.") LIKE LOWER(CONCAT('%',:search,'%')) ORDER BY ".$column." ".$direction." LIMIT ".$limit." OFFSET ".$offset;

    return $this->query($query,array("search"=>$search));
  }




}
 ?>
