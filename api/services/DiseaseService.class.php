<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/DiseasesDao.class.php";
require_once dirname(__FILE__)."/../dao/SymptomDiseaseBodyPartLogDao.class.php";

class DiseaseService extends BaseService{
  protected $sdbl;
  public function __construct(){
    $this->dao = new DiseasesDao();
    $this->sdbl = new SymptomDiseaseBodyPartLogDao();
  }

  public function get_diseases_by_name($name,$offset = 0,$limit = 10,$order="-id",$total = FALSE){
    return $this->dao->get_entity_by_search($name,$offset,$limit,$order,"name", $total);
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

  public function get_user_diseases($user_id, $offset, $limit, $order, $search,$total=FALSE){
    return $this->dao->get_user_diseases($user_id,$offset,$limit,$order,$search,$total);
  }

  public function add_symptom_for_disease($data){
    $object = [
      "disease_id"=>$data["disease_id"],
      "symptom_id"=>$data["symptom_id"],
      "body_part_id"=>@$data["body_part_id"]
    ];
    $returned_instance = $this->sdbl->add($object);
    return $this->sdbl->get_pretty($returned_instance["id"]);

  }

  public function get_disease_popularity(){
    return $this->dao->get_disease_popularity();
  }

}


 ?>
