<?php
  Flight::route("GET /bodyparts", function(){
    $search = Flight::query("search");
    $offset = Flight::query("offset",0);
    $limit = Flight::query("limit",10);
    $order = Flight::query("order","-id");
    if($search){
      Flight::json(Flight::bodyPartService()->get_bodyparts_by_name($search, $offset, $limit, $order));
    }
    else{
      Flight::json(Flight::bodyPartService()->get_all($offset,$limit,$order));
    }
  });

  Flight::route("GET /bodyparts/@id", function($id){
    Flight::json(Flight::bodyPartService()->get_by_id($id));
  });

  Flight::route("POST /bodyparts", function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bodyPartService()->add($data));
  });

  Flight::route("PUT /bodyparts/@id", function($id){
    $data = Flight::request()->data->getData();
    $bp=Flight::bodyPartService()->update($data,$id);
    Flight::json(Flight::bodyPartService()->get_by_id($bp["id"]));
  });

  Flight::route("GET /bodyparts/@id/diseases", function($id){
    $offset = Flight::query("offset",0);
    $limit = Flight::query("limit",10);
    $order = Flight::query("order","-id");
    Flight::json(Flight::bodyPartService()->get_bodypart_diseases($id,$offset,$limit,$order));
  })

 ?>
