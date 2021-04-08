<?php
  require_once dirname(__FILE__)."/BaseDao.class.php";

  class DiseaseMedicineLogDao extends BaseDao{
    public function __construct(){
      parent::__construct("disease_medicine_log");
    }

    public function get_medicine_disease_log_with_names($id){
      $query = "SELECT dml.id as id, d.name as disease_name, m.name as medicine_name from disease_medicine_log dml
                JOIN diseases d ON dml.disease_id = d.id
                JOIN medicines m ON dml.medicine_id = m.id
                WHERE dml.id = :id";
      return $this->query_single($query,["id"=>$id]);
    }
  }
 ?>
