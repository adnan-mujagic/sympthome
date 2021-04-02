<?php
  Flight::route("*",function(){
    if(str_starts_with(Flight::request()->url,"/users/")){
      if(str_starts_with(Flight::request()->url,"/users/byId")){
        $headers = getallheaders();
        $token = @$headers["Authentication"];
        try {
          $decoded = (array)\Firebase\JWT\JWT::decode($token, "SECRET", array('HS256'));
          Flight::set('user', $decoded);
          return TRUE;

        } catch (\Exception $e) {
          Flight::json(["message"=>"Make sure to log in before doing this action!"]);
        }
      }
      return TRUE;
    }



  })

 ?>
