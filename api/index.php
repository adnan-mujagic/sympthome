<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




require_once dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/SymptomService.class.php";

//Register Classes Here
Flight::register("user","UsersDao");
Flight::register("userService","UserService");
Flight::register("symptomService", "SymptomService");



Flight::map("query",function($name,$default_value=NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return $query_param;

});
//Here we need to add the routes that are placed in the other folder...
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/symptoms.php";






Flight::start();


 ?>
