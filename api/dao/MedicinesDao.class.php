<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class MedicinesDao extends BaseDao{

  public function __construct(){
    parent::__construct("medicines");
  }

  public function get_user_medicines($user_id, $offset, $limit, $order, $search){
    list($column, $direction) = $this->parse_order($order);
    $params=[];
    $query = "SELECT m.name, m.instruction, m.warning , m.side_effects, m.requires_prescription FROM medicines m
              JOIN disease_medicine_log dml ON dml.medicine_id = m.id
              JOIN diseases d ON d.id = dml.disease_id
              JOIN symptom_disease_bodypart_log sdbl ON sdbl.disease_id = d.id
              JOIN symptoms s ON s.id = sdbl.symptom_id
              JOIN user_symptom_log usl ON usl.symptom_id = s.id
              JOIN users u ON u.id = usl.user_id
              WHERE u.id = ".$user_id;
              if(isset($search)){
                $query=$query." AND LOWER(m.name) LIKE LOWER(CONCAT('%',:search,'%'))";
                $params["search"]=$search;
              }
              $query=$query." GROUP BY m.id ORDER BY m.".$column." ".$direction." LIMIT ".$limit." OFFSET ".$offset;
              return $this->query($query,$params);
  }

}


 ?>
