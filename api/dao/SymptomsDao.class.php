<?php

  require_once dirname(__FILE__)."/BaseDao.class.php";



  class SymptomsDao extends BaseDao{

    public function __construct(){
      parent::__construct("symptoms");
    }

    public function get_user_symptoms($user_id,$offset,$limit,$order,$search=NULL,$total=FALSE){
      list($column, $direction) = $this->parse_order($order);
      $query="SELECT ";
      if($total){
        $query.="COUNT(s.id) AS total";
      }
      else{
        $query.="s.id AS id,s.name AS name";
      }
      $params = [];
      $query .= " FROM symptoms s
                JOIN user_symptom_log usl ON usl.symptom_id = s.id
                JOIN users u ON u.id = usl.user_id
                WHERE u.id =".$user_id." AND usl.status = 'ACTIVE'";
      if(isset($search)){
        $query=$query." AND LOWER(s.name) LIKE LOWER(CONCAT('%',:search,'%'))";
        $params["search"]=$search;
      }
      if($total){
        print_r($query);
        return $this->query_single($query, $params);
      }
      else{
        $query=$query." ORDER BY s.".$column." ".$direction.
                      " LIMIT ".$limit." OFFSET ".$offset;
                      print_r($query);
        return $this->query($query, $params);
      }

    }

  }


 ?>
