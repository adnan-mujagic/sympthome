<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__). "/dao/UsersDao.class.php";

$userdao = new UsersDao();

$user = $userdao->get_user_by_id(1);

print_r($user);

 ?>
