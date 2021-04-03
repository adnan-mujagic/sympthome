<?php
  class BaseService{
    protected $dao;

    public function __construct($dao){
      $this->dao=$dao;
    }

    public function add($data){
      return $this->dao->add($data);
    }

    public function get_by_id($id){
      return $this->dao->get_by_id($id);
    }

    public function get_all($offset = 0, $limit = 25, $order="-id"){
      return $this->dao->get_all($offset, $limit, $order);
    }

    public function update($updates, $id){
      //Makes sure that if you are updating the password, in that case it gets hashed!
      if(isset($updates["password"])){
        $updates["password"] = md5($updates["password"]);
      }
      return $this->dao->update($updates,$id);
    }

    public function query($query, $params){
      return $this->dao->query($query, $params);
    }

  }

 ?>
