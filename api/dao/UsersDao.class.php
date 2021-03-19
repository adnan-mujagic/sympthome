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

  public function get_user_by_name($name, $offset, $limit,$order){
    $column = substr($order,1);
    switch (substr($order,0,1)) {
      case "+":
        $direction = "DESC";
        break;
      case "-":
        $direction = "ASC";
        break;
      default:
        // code...
        throw new Exception("Invalid order parameter, you should use +(descending) or - (ascending) before the column name to indicate the direction of order");
    }
    $query = "SELECT * FROM users
              WHERE LOWER(first_name) LIKE LOWER(CONCAT('%',:name,'%'))
              OR LOWER(last_name) LIKE LOWER(CONCAT('%',:name,'%'))
              ORDER BY ".$column." ".$direction."
              LIMIT ".$limit." OFFSET ".$offset;
              
    return $this->query($query, ["name"=>$name]);
  }

  public function get_user_by_token($token){
    return $this->query_single("SELECT * FROM users WHERE token=:token",["token"=>$token]);
  }


}

 ?>
