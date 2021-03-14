<?php

  require_once dirname(__FILE__)."/BaseDao.class.php";



  class SymptomsDao extends BaseDao{

    public function __construct(){
      parent::__construct("symptoms");
    }

    public function get_symptom_by_name($name){
      return $this->query("SELECT * FROM symptoms WHERE name LIKE '%$name%';", array());

    }

    public function update_symptom($updates,$id){
      $this->update("symptoms",$updates,$id);
    }

    public function insert_symptom($symptom){
      $this->insert("symptoms",$symptom);
    }

  }


 ?>
