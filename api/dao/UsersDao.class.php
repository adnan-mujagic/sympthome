<?php
/**
 *
 */

require_once dirname(__FILE__)."/BaseDao.class.php";
class UsersDao extends BaseDao{


  public function __construct(){
    parent::__construct("users");
  }

  public function get_user_by_email($email){
      return $this->query_single("SELECT * FROM users WHERE email=:email",["email"=>$email]);
  }

  public function get_user_by_id($id){
    return $this->query_single("SELECT * FROM users WHERE id=:id",["id"=>$id]);
  }

  public function insert_user($entity){
    this->insert("users",$entity);
  }
}

 ?>
