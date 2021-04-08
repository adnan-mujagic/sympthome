<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/MedicinesDao.class.php";
require_once dirname(__FILE__)."/../dao/DiseaseMedicineLogDao.class.php";

class MedicineService extends BaseService{
  protected $dml;
  public function __construct(){
    $this->dao = new MedicinesDao();
    $this->dml = new DiseaseMedicineLogDao();
  }

  public function get_medicines_by_name($search,$offset=0,$limit=10,$order="-id"){
    return $this->dao->get_entity_by_search($search,$offset,$limit,$order);
  }

  public function add_medicine($data){
    //DATA VALIDATION (WHITELISTED WHAT WE NEED)
    $medicine = [
      "name"=>$data["name"],
      "instruction"=>$data["instruction"],
      "warning"=>$data["warning"],
      "side_effects"=>$data["side_effects"],
      "requires_prescription"=>$data["requires_prescription"],
      "date_added"=>date(Config::DATE_FORMAT)
    ];
    return $this->dao->add($medicine);
  }

  public function get_user_medicines($user_id, $offset, $limit, $order, $search){
    return $this->dao->get_user_medicines($user_id, $offset, $limit, $order, $search);
  }

  public function add_disease_for_medicine($data){
    $object = [
      "medicine_id"=>$data["medicine_id"],
      "disease_id"=>$data["disease_id"]
    ];
    $created_instance = $this->dml->add($object);
    return $this->dml->get_medicine_disease_log_with_names($created_instance["id"]);
  }
}


 ?>
