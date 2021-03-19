<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/SymptomsDao.class.php";

class SymptomService extends BaseService{
  public function __construct(){
    parent::__construct(new SymptomsDao());
  }

  public function get_symptoms_by_name($name){
    $query = "SELECT * FROM symptoms
              WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'))";
    return $this->query($query,["name"=>$name]);
  }
}

 ?>
