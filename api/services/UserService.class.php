<?php
  require_once dirname(__FILE__)."/../dao/UsersDao.class.php";
  require_once dirname(__FILE__)."/BaseService.class.php";
  require_once dirname(__FILE__)."/../config.php";

  class UserService extends BaseService{
    public function __construct(){
      parent::__construct(new UsersDao());
    }

    public function register($data){
      $data["created_at"]=date(Config::DATE_FORMAT);
      $data["token"]=md5(random_bytes(16));

      // TODO: SEND EMAIL
      return $this->add($data);
    }

    public function get_users($search,$offset,$limit,$order){
      if($search){
        Flight::json($this->dao->get_user_by_name($search,$offset,$limit,$order));
      }
      else{
        Flight::json($this->dao->get_all($offset, $limit,$order));
      }
    }

    public function get_user_symptoms($user_id){
      $query = "SELECT s.name FROM symptoms s
                JOIN user_symptom_log usl ON usl.symptom_id=s.id
                JOIN users u on usl.user_id=u.id
                WHERE u.id=:user_id";

      return $this->query($query, ["user_id"=>$user_id]);
    }

    public function get_user_diseases($user_id){
      $query = "SELECT d.id, d.name, d.description, d.treatment_description FROM diseases d
                JOIN symptom_disease_bodypart_log sdbl ON sdbl.disease_id=d.id
                JOIN symptoms s ON s.id = sdbl.symptom_id
                JOIN user_symptom_log usl ON usl.symptom_id = s.id
                JOIN users u ON u.id = usl.user_id
                WHERE u.id = :id
                GROUP BY d.id ";
      return $this->query($query, ["id"=>$user_id]);
    }

    public function confirm($token){
      $user = $this->dao->get_user_by_token($token);
      if($user){
        $this->update(["status"=>"ACTIVE"],$user["id"]);
        return $this->get_by_id($user["id"]);

      }
    }




  }



 ?>
