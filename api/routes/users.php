<?php


Flight::route("GET /users",function(){

  //Flight::json(Flight::user()->get_all());

  $limit = Flight::query("limit",10);
  $offset = Flight::query("offset",0);
  $search = Flight::query("search");

  Flight::userService()->get_users($search,$offset,$limit);
});

Flight::route("GET /users/@id",function($id){
  Flight::json(Flight::user()->get_by_id($id));
});

Flight::route("POST /users",function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::user->add($data));
});

Flight::route("PUT /users/@id",function($id){
  $data=Flight::request()->data->getData();
  Flight::user()->update($data,$id);
  Flight::json(Flight::user()->get_by_id($id));
})


 ?>