<?php

  require_once dirname(__FILE__)."/BaseDao.class.php";



  class SymptomsDao extends BaseDao{

    public function __construct(){
      parent::__construct("symptoms");
    }

    public function get_symptoms_by_name($name,$offset,$limit,$order){
      list($column, $direction) = parent::parse_order($order);
      return $this->query("SELECT *
                           FROM symptoms
                           WHERE LOWER(name) LIKE LOWER(CONCAT('%',:name,'%'))
                           ORDER BY ".$column." ".$direction."
                           LIMIT ".$limit." OFFSET ".$offset, array("name"=>$name));

    }
  }


 ?>
