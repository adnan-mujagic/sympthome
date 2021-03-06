<?php
  require_once dirname(__FILE__)."/../dao/UsersDao.class.php";
  require_once dirname(__FILE__)."/BaseService.class.php";
  require_once dirname(__FILE__)."/../config.php";
  require_once dirname(__FILE__)."/../clients/SMTPClient.class.php";
  require_once dirname(__FILE__)."/../dao/UserSymptomLogDao.class.php";



  class UserService extends BaseService{
    protected $smtp;
    protected $usl;
    public function __construct(){
      parent::__construct(new UsersDao());
      $this->smtp = new SMTPClient();
      $this->usl = new UserSymptomLogDao();
    }

    public function register($data){
      $data["created_at"]=date(Config::DATE_FORMAT);
      $data["token"]=md5(random_bytes(16));
      $data["token_created_at"]=date(Config::DATE_FORMAT);
      $data["password"]=md5($data["password"]);

      // TODO: SEND EMAIL
      try {
        $this->dao->beginTransaction();
        $data=$this->add($data);

        $this->smtp->send_confirmation_email($data);
        $this->dao->commit();
        return $data;

      } catch (\Exception $e) {
        $this->dao->rollback();
        //HERE WE CAN CHECK IF THE PROBLEM IS A DUPLICATE ENTRY IN TERMS OF EMAIL
        //BY CHECKING THE STRING OF THE ERROR MESSAGE, AND IN THAT CASE WE CAN THROW
        //ANOTHER ERROR WITH A CUSTOM, USER FRIENDLY MESSAGE
        if(str_contains($e->getMessage(),"Duplicate entry")){
          throw new Exception("There is already a user with email: ".$data["email"].". Please try another email address.", 400, $e);
        }
        throw $e;
      }



    }

    public function get_users($search,$offset,$limit,$order,$total=FALSE){
      if($search){
        return $this->dao->get_user_by_name($search,$offset,$limit,$order,$total);
      }
      else{
        return $this->dao->get_all($offset, $limit,$order,$total);
      }
    }


    public function confirm($token){
      $user = $this->dao->get_user_by_token($token);
      if($user){
        $this->update(["status"=>"ACTIVE","token"=> md5(random_bytes(16))],$user["id"]);
        $this->smtp->send_activation_successful_email($user);
        return $this->dao->get_by_id($user["id"]);

      }
    }

    public function login($data){
      $user = $this->dao->get_user_by_email($data["email"]);
      if(!isset($user["id"])){
        throw new Exception("User with that email does not exist in our database!",400);
      }
      if($user["status"]!="ACTIVE"){
        throw new Exception("That email address is not confirmed! Confirm your email before accessing your account!",400);
      }
      if($user["password"]!=md5($data["password"])){
        throw new Exception("Invalid password!",400);
      }

      return $user;

    }

    public function forgot($data){
      $user = $this->dao->get_user_by_email($data["email"]);
      if(!isset($user)){
        throw new Exception("User does not exist!",400);
      }

      if(strtotime(date(Config::DATE_FORMAT))-strtotime($user["token_created_at"])<5*60){
        throw new Exception("Your token generation cooldown has not expired yet, try again in 5 mins!",400);
      }

      $this->dao->update(["token"=>md5(random_bytes(16)), "token_created_at"=>date(Config::DATE_FORMAT)],$user["id"]);
      $this->smtp->send_password_recovery_token_email($this->dao->get_user_by_email($data["email"]));
    }

    public function reset($data){
      $user = $this->dao->get_user_by_token($data["token"]);
      if(!isset($user)){
        throw new Exception("There is no user with that token!",400);
      }
      if(strtotime(date(Config::DATE_FORMAT))-strtotime($user["token_created_at"])>5*60){
        throw new Exception("Token expired!");
      }
      $this->dao->update(["password"=>md5($data["password"])],$user["id"]);
      return $this->dao->get_by_id($user["id"]);
    }

    public function add_symptom($data){
      $existing_object = $this->usl->get_user_symptoms($data["symptom_id"], Flight::get("user")["id"]);
      if(!$existing_object){
        $data["user_id"]=Flight::get("user")["id"];
        return $this->usl->add($data);
      }else if($existing_object && $existing_object["status"]!="ACTIVE"){
        return $this->usl->update(["status"=>"ACTIVE"], $existing_object["id"]);
      }
      else{
        throw new Exception("You have already added this symptom!");
      }

    }


    public function delete_symptom($data, $user_id){
      $object_to_update = $this->usl->get_user_symptoms($data["symptom_id"], $user_id);
      return $this->usl->update(["status"=>"DELETED"],$object_to_update["id"]);
    }
  }



 ?>
