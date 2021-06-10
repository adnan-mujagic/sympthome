<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class DiseasesDao extends BaseDao{

  public function __construct(){
    parent::__construct("diseases");

  }

  public function get_diseases_by_id($id){
    return $this->query_single("SELECT * FROM diseases WHERE id=:id",array("id"=>$id));
  }

  //THIS FUNCTION IS NOT NEEDED ANYMORE
  /*
  public function get_diseases_by_name($name,$offset,$limit,$order){
    list($column,$direction) = parent::parse_order($order);
    return $this->query("SELECT * FROM diseases
                         WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'))
                         ORDER BY ".$column." ".$direction."
                         LIMIT ".$limit." OFFSET ".$offset,array("name"=>$name));
  }*/


  public function get_user_diseases($user_id,$offset,$limit,$order,$search){
    list($column,$direction) = $this->parse_order($order);
    $params = [];
    $query = "SELECT d.name, d.description, d.treatment_description, d.category_id FROM diseases d
              JOIN symptom_disease_bodypart_log sdbl on sdbl.disease_id = d.id
              JOIN symptoms s ON s.id = sdbl.symptom_id
              JOIN user_symptom_log usl ON s.id = usl.symptom_id
              JOIN users u ON u.id = usl.user_id
              WHERE u.id = ".$user_id." AND usl.status = 'ACTIVE'";
    if(isset($search)){
      $query= $query." AND LOWER(d.name) LIKE LOWER(CONCAT('%',:search,'%'))";
      $params["search"]=$search;
    }
    $query = $query." GROUP BY d.id ORDER BY d.".$column." ".$direction.
                    " LIMIT ".$limit." OFFSET ".$offset;
    return $this->query($query,$params);
  }

  public function get_disease_popularity(){
    $query = "SELECT d.name, COUNT(u.id) FROM diseases d
              JOIN symptom_disease_bodypart_log sdbl ON d.id = sdbl.disease_id
              JOIN symptoms s ON sdbl.symptom_id=s.id
              JOIN user_symptom_log usl ON usl.symptom_id=s.id
              JOIN users u ON u.id = usl.user_id
              WHERE usl.status='ACTIVE'
              group by d.name";
    return $this->query($query,array());

  }
}

 ?>
