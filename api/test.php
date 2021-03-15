<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__). "/dao/UsersDao.class.php";
require_once dirname(__FILE__)."/dao/SymptomsDao.class.php";
require_once dirname(__FILE__)."/dao/MedicinesDao.class.php";
require_once dirname(__FILE__)."/dao/DiseasesDao.class.php";

$userdao = new UsersDao();
$symdao = new SymptomsDao();
$medicinedao = new MedicinesDao();
$diseasedao = new DiseasesDao();


$updates=[

  "age"=>23,
  "password"=>"not a strong password",

];

print_r($userdao->update($updates,7));

 ?>
