<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/SymptomService.class.php";
require_once dirname(__FILE__)."/services/DiseaseService.class.php";
require_once dirname(__FILE__)."/services/MedicineService.class.php";
require_once dirname(__FILE__)."/services/BodyPartService.class.php";
require_once dirname(__FILE__)."/config.php";

Flight::set('flight.log_errors', TRUE);

//Register Classes Here
Flight::register("user","UsersDao");
Flight::register("userService","UserService");
Flight::register("symptomService", "SymptomService");
Flight::register("diseaseService", "DiseaseService");
Flight::register("medicineService","MedicineService");
Flight::register("bodyPartService", "BodyPartService");

//Error exception function
Flight::map("error",function(Exception $e){
  Flight::json(["message"=>$e->getMessage()], 500);
});

/*Utility function to return query parameters*/
Flight::map("query",function($name,$default_value=NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);

});

/*Flight general function that returns decoded Authentication token*/
Flight::map("header", function($name){
  return @getallheaders()[$name];

});

//Flight function that will return a json web token (jwt) for the user in the parameters
Flight::map("jwt",function($user){
  return \Firebase\JWT\JWT::encode(["exp"=>time()+Config::JWT_TOKEN_TIME,"id"=>$user["id"], "role"=>$user["type"]], Config::JWT_SECRET);
});

Flight::route("GET /documentation", function(){
  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

Flight::route("GET /", function(){
  Flight::redirect("/docs");
});
//Here we need to add the routes that are placed in the other folder...
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/symptoms.php";
require_once dirname(__FILE__)."/routes/diseases.php";
require_once dirname(__FILE__)."/routes/medicines.php";
require_once dirname(__FILE__)."/routes/bodyparts.php";

Flight::start();
 ?>
