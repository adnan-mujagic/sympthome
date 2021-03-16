<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once dirname(__FILE__). "/dao/UsersDao.class.php";
  require_once dirname(__FILE__)."/dao/SymptomsDao.class.php";
  require_once dirname(__FILE__)."/dao/MedicinesDao.class.php";
  require_once dirname(__FILE__)."/dao/DiseasesDao.class.php";
  require_once dirname(__FILE__)."/dao/BodyPartsDao.class.php";

  $userdao = new UsersDao();
  $symdao = new SymptomsDao();
  $medicinedao = new MedicinesDao();
  $diseasedao = new DiseasesDao();
  $bpdao = new BodyPartsDao();


  $bp = array(
    "name"=>"Stomach"
  );

  //TESTING HERE
  //Basic functions of the following classes are working:
  //-UsersDao
  //-SymptomsDao
  //-MedicinesDao
  //-DiseasesDao
  //-BodyPartsDao



  print_r($bpdao->get_symptoms_related_to_bodypart(2));



?>
