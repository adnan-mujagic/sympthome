<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/DiseasesDao.class.php";

class DiseaseService extends BaseService{

  public function __construct(){
    $this->dao = new DiseasesDao();
  }

  public function get_diseases_by_name($name,$offset = 0,$limit = 10,$order="-id"){
    return $this->dao->get_entity_by_search($name,$offset,$limit,$order);
  }
  public function add_disesase($data){
    $disease=[
      "name"=>$data["name"],
      "description"=>$data["description"],
      "treatment_description"=>$data["treatment_description"],
      "category_id"=>$data["category_id"],
      "date_added"=>date(Config::DATE_FORMAT)
    ];
    return $this->dao->add($disease);
  }

}


 ?>
