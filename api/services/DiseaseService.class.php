<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/DiseasesDao.class.php";

class DiseaseService extends BaseService{

  public function __construct(){
    $this->dao = new DiseasesDao();
  }

  public function get_diseases_by_name($name,$offset = 0,$limit = 10,$order="-id"){
    return $this->dao->get_diseases_by_name($name,$offset,$limit,$order);
  }

}


 ?>
