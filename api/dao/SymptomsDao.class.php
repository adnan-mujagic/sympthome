<?php

  require_once dirname(__FILE__)."/BaseDao.class.php";



  class SymptomsDao extends BaseDao{

    public function __construct(){
      parent::__construct("symptoms");
    }

    public function get_user_symptoms($user_id,$offset,$limit,$order,$search=NULL){
      list($column, $direction) = $this->parse_order($order);
      $params = [];
      $query = "SELECT s.id AS id,s.name AS name FROM symptoms s
                JOIN user_symptom_log usl ON usl.symptom_id = s.id
                JOIN users u ON u.id = usl.user_id
                WHERE u.id =".$user_id." AND usl.status = 'ACTIVE'";
      if(isset($search)){
        $query=$query." AND LOWER(s.name) LIKE LOWER(CONCAT('%',:search,'%'))";
        $params["search"]=$search;
      }
      $query=$query." ORDER BY s.".$column." ".$direction.
                    " LIMIT ".$limit." OFFSET ".$offset;
      return $this->query($query, $params);
    }

  }


 ?>
