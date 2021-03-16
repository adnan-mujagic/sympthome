<?php
  require_once dirname(__FILE__)."/BaseDao.class.php";

  /**
   *
   */
  class BodyPartsDao extends BaseDao{

    public function __construct(){
      parent::__construct("body_parts");
    }

    public function get_diseases_related_to_bodypart($id){
      $query="SELECT d.name, d.description FROM diseases d JOIN symptom_disease_bodypart_log sdbl ON sdbl.disease_id=d.id JOIN body_parts bp ON bp.id=sdbl.body_part_id
      WHERE bp.id=:id GROUP BY d.id";
      return $this->query($query,["id"=>$id]);
    }

    public function get_symptoms_related_to_bodypart($id){
      $query="SELECT s.name as Symptom_Name FROM symptoms s
              JOIN symptom_disease_bodypart_log sdbl ON sdbl.symptom_id=s.id
              JOIN body_parts bp ON bp.id=sdbl.body_part_id
              WHERE bp.id=:id
              GROUP BY s.id";
      return $this->query($query,["id"=>$id]);

    }
  }



 ?>
