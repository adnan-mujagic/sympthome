<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/MedicinesDao.class.php";

class MedicineService extends BaseService{
  public function __construct(){
    $this->dao = new MedicinesDao();
  }

  public function get_medicines_by_name($search,$offset=0,$limit=10,$order="-id"){
    return $this->dao->get_entity_by_search($search,$offset,$limit,$order);
  }
}


 ?>
