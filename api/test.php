<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once dirname(__FILE__)."/clients/SMTPClient.class.php";
  require_once dirname(__FILE__)."/dao/UsersDao.class.php";
  require_once dirname(__FILE__)."/dao/DiseasesDao.class.php";
  require_once dirname(__FILE__)."/services/DiseaseService.class.php";
  require_once dirname(__FILE__)."/services/SymptomService.class.php";


  print_r("This thing works!");
  $ss = new DiseaseService();
  print_r($ss->get_user_diseases(1,0,10,"-id",NULL, FALSE));
  die;

  /*$smtp = new SMTPClient();
  $smtp->test();
  die;
  $userdao = new UsersDao();
  $smtp->send_confirmation_email($userdao->get_by_id(1));*/



/*  require_once dirname(__FILE__)."/dao/SymptomsDao.class.php";
  require_once dirname(__FILE__)."/dao/MedicinesDao.class.php";
  require_once dirname(__FILE__)."/dao/DiseasesDao.class.php";
  require_once dirname(__FILE__)."/dao/BodyPartsDao.class.php";
  require_once dirname(__FILE__)."/dao/UserSymptomLogDao.class.php";
  require_once dirname(__FILE__)."/dao/SymptomDiseaseBodyPartLogDao.class.php";
  require_once dirname(__FILE__)."/dao/DiseaseMedicineLogDao.class.php";
  require_once dirname(__FILE__)."/dao/DiseaseCategoriesDao.class.php";





  $userdao = new UsersDao();
  $symdao = new SymptomsDao();
  $medicinedao = new MedicinesDao();
  $diseasedao = new DiseasesDao();
  $bpdao = new BodyPartsDao();
  $usl = new UserSymptomLogDao();
  $sdbl = new SymptomDiseaseBodyPartLogDao();
  $dm = new DiseaseMedicineLogDao();
  $dc = new DiseaseCategoriesDao();


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
  //-UserSymptomLogDao
  //-SymptomDiseaseBodyPartLogDao





  print_r($symdao->get_symptom_by_name("pain"));

*/



?>
