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
    return $this->query_single("SELECT * FROM users WHERE email=:email",array("email"=>$email));
  }

  public function get_user_by_id($id){
    return $this->query_single("SELECT * FROM users WHERE id=:id",array("id"=>$id));
  }

  public function insert_user($user){
    $this->insert("users",$user);

  }

  public function update_user($id, $updates){
    $this->update("users",$updates,$id);
  }

  public function get_user_symptoms($id){
    $query="SELECT s.name as Symptom FROM symptoms s JOIN user_symptom_log usl ON usl.symptom_id=s.id JOIN users u ON u.id=usl.user_id WHERE u.id=:id";


    return $this->query($query,array("id" =>$id ));
  }


}

 ?>
