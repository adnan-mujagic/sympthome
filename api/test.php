<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__). "/dao/UsersDao.class.php";

$userdao = new UsersDao();

$user = [
  "first_name"=>"Muhamed",
  "last_name"=>"Begic",
  "age"=>21,
  "password"=>"begara123",
  "email"=>"muki@ba"
];
$userdao->insert_user($user);

print_r($user);

 ?>
