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

    public function get_all(){
      return $this->dao->get_all();
    }

    public function update($updates, $id){
      return $this->dao->update($updates,$id);
    }

  }

 ?>
