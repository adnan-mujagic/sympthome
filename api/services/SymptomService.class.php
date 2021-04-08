<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/SymptomsDao.class.php";
require_once dirname(__FILE__)."/../dao/SymptomDiseaseBodyPartLogDao.class.php";

class SymptomService extends BaseService{
  protected $sdbl;
  public function __construct(){
    parent::__construct(new SymptomsDao());
    $this->sdbl=new SymptomDiseaseBodyPartLogDao();
  }

  public function get_symptoms_by_name($name,$offset = 0, $limit = 25, $order="-id"){

    return $this->dao->get_entity_by_search($name,$offset,$limit,$order);
    /*$query = "SELECT * FROM symptoms
              WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'))";
    return $this->query($query,["name"=>$name]);*/
  }

  public function add_symptom($data){
    $symptom = [
      "name" => $data["name"],
      "date_added" =>date(Config::DATE_FORMAT)
    ];
    return $this->dao->add($symptom);
  }

  public function get_user_symptoms($user_id, $offset, $limit, $order, $search=NULL){
    return $this->dao->get_user_symptoms($user_id,$offset,$limit, $order, $search);
  }

  public function add_disease_for_symptom($data){
    $object=[
      "disease_id"=>$data["disease_id"],
      "symptom_id"=>$data["symptom_id"],
      "body_part_id"=>@$data["body_part_id"]
    ];
    $returned_instance=$this->sdbl->add($object);
    return $this->sdbl->get_pretty($returned_instance["id"]);
  }
}



 ?>
