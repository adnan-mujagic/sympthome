<?php
//ROUTES FOR MEDICINES
Flight::route("GET /medicines",function(){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",10);
  $order = Flight::query("order","-id");
  if(!$search){
    Flight::json(Flight::medicineService()->get_all($offset,$limit,$order));
  }
  else{
    Flight::json(Flight::medicineService()->get_medicines_by_name($search,$offset,$limit,$order));
  }
});

Flight::route("GET /medicines/@id",function($id){
  Flight::json(Flight::medicineService()->get_by_id($id));
});

Flight::route("POST /medicines",function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->add($data));
});

Flight::route("PUT /medicines/@id",function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->update($data,$id));
});



 ?>
