<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class SymptomDiseaseBodyPartLogDao extends BaseDao{
  public function __construct(){
    parent::__construct("symptom_disease_bodypart_log");
  }

  public function get_pretty($id){
    $query = "SELECT sdbl.id, s.name as symptom_name, d.name as disease_name FROM symptom_disease_bodypart_log sdbl
              JOIN symptoms s ON sdbl.symptom_id = s.id
              JOIN diseases d ON sdbl.disease_id = d.id
              WHERE sdbl.id = :id";
    return $this->query_single($query,["id"=>$id]);
  }
}
 ?>
