<?php

  require_once dirname(__FILE__)."/BaseDao.class.php";



  class SymptomsDao extends BaseDao{

    public function __construct(){
      parent::__construct("symptoms");
    }

    public function get_symptom_by_name($name){
      return $this->query("SELECT * FROM symptoms WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'));", array("name"=>$name));

    }
  }


 ?>
