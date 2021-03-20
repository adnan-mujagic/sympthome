<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class DiseasesDao extends BaseDao{

  public function __construct(){
    parent::__construct("diseases");

  }

  public function get_diseases_by_id($id){
    return $this->query_single("SELECT * FROM diseases WHERE id=:id",array("id"=>$id));
  }

  public function get_diseases_by_name($name,$offset,$limit,$order){
    list($column,$direction) = parent::parse_order($order);
    return $this->query("SELECT * FROM diseases
                         WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'))
                         ORDER BY ".$column." ".$direction."
                         LIMIT ".$limit." OFFSET ".$offset,array("name"=>$name));
  }

}

 ?>
