<?php
  require_once dirname(__FILE__)."/BaseDao.class.php";

  class DiseaseMedicineLogDao extends BaseDao{
    public function __construct(){
      parent::__construct("disease_medicine_log");
    }
  }
 ?>
