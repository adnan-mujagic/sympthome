<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class DiseaseCategoriesDao extends BaseDao{
  public function __construct(){
    parent::__construct("disease_categories");
  }
}
 ?>
