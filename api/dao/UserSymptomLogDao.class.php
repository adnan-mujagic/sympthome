<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserSymptomLogDao extends BaseDao{
  public function __construct(){
    parent::__construct("user_symptom_log");
  }
}
 ?>
