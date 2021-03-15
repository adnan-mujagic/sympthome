<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class DiseasesDao extends BaseDao{

  public function __construct(){
    parent::__construct("diseases");

  }

  public function get_diseases_by_id($id){
    return $this->query_single("SELECT * FROM diseases WHERE id=:id",array("id"=>$id));
  }

  public function get_diseases_by_name($name){
    return $this->query("SELECT * FROM diseases WHERE name LIKE '%$name%'",array());
  }

  public function update_disease($updates, $id){
    $this->update("diseases",$updates,$id);
  }

  public function insert_disease($disease){
    $this->insert("diseases",$disease);
  }
}

 ?>
