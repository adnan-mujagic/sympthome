<?php

  //NORMAL USER ROUTES!
  Flight::route("/users/*",function(){
    try {
      $decoded = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, array('HS256'));
      Flight::set('user', $decoded);
      return TRUE;

    } catch (\Exception $e) {
      Flight::json(["message"=>"Make sure to log in before doing this action!"]);
      die;
    }
  });

  //ADMIN ROUTES
  Flight::route("/admin/*", function(){
    try {
      $decoded = (array) \Firebase\JWT\JWT::decode(Flight::header("Authentication"),Config::JWT_SECRET, array("HS256"));
      if($decoded["role"]!="ADMIN"){
        throw new Exception("This route requires admin credentials!",403);
      }
      Flight::set("user", $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message"=>$e->getMessage()],401);
      die;
    }



  })



 ?>
