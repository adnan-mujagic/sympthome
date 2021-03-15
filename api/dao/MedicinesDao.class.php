<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicinesDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }

  public function get_medicine_by_id($id){
    return $this->query_single("SELECT * from medicines WHERE id=:id",array("id"=>$id));

  }

  public function get_medicine_by_name($name){
    return $this->query("SELECT * FROM medicines WHERE name LIKE '%$name%'",array());
  }

}


 ?>
