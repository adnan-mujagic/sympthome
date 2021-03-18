<?php
  require_once dirname(__FILE__)."/../dao/UsersDao.class.php";
  require_once dirname(__FILE__)."/BaseService.class.php";

  class UserService extends BaseService{
    public function __construct(){
      parent::__construct(new UsersDao());
    }

    public function get_users($search,$offset,$limit){
      if($search){
        Flight::json($this->dao->get_user_by_name($search,$offset,$limit));
      }
      else{
        Flight::json($this->dao->get_all());
      }
    }


  }



 ?>
