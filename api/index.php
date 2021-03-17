<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/dao/UsersDao.class.php";

Flight::register("user","UsersDao");


Flight::route("/",function(){
  echo "Hello world";
});

Flight::route("/users",function(){
  Flight::json(Flight::user()->get_all());
});

Flight::route("/users/@id",function($id){
  Flight::json(Flight::user()->get_by_id($id));
});
Flight::start();


 ?>
