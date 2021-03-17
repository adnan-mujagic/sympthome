<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class SymptomDiseaseBodyPartLogDao extends BaseDao{
  public function __construct(){
    parent::__construct("symptom_disease_bodypart_log");
  }
}
 ?>
