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
    return $this->dao->get_bodypart_diseases($id, $offset, $limit, $order);
  }

}

 ?>
