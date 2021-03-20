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
      return $this->dao->update($updates,$id);
    }

    public function query($query, $params){
      return $this->dao->query($query, $params);
    }

  }

 ?>
