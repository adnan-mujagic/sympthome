<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BodyPartsDao.class.php";


class BodyPartService extends BaseService{
  public function __construct(){
    $this->dao = new BodyPartsDao();
  }

  public function get_bodyparts_by_name($search, $offset, $limit, $order){
    return $this->dao->get_entity_by_search($search, $offset, $limit, $order);
  }

  public function get_bodypart_diseases($id, $offset=0, $limit = 0,$order="-id"){

    list($column,$direction) = $this->dao->parse_order($order);
    $column = "d.".$column;


    $query = "SELECT d.name, d.description, d.treatment_description FROM diseases d
              JOIN symptom_disease_bodypart_log sdbl on sdbl.disease_id = d.id
              JOIN body_parts bp ON bp.id = sdbl.body_part_id
              WHERE bp.id = :id
              GROUP BY d.name
              ORDER BY ".$column." ".$direction." LIMIT ".$limit." OFFSET ".$offset;

    return $this->dao->query($query, ["id"=>$id]);
  }

}

 ?>
