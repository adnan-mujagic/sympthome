<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserSymptomLogDao extends BaseDao{
  public function __construct(){
    parent::__construct("user_symptom_log");
  }

  public function get_user_symptoms($symptom_id, $user_id){
    $query = "SELECT * FROM user_symptom_log WHERE symptom_id=:symptom_id AND user_id=:user_id";
    return $this->query_single($query,array("symptom_id"=>$symptom_id,"user_id"=>$user_id));
  }
}


 ?>
