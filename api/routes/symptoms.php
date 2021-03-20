<?php
Flight::route("GET /symptoms", function(){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",10);
  $order = Flight::query("order","-id");
  if($search){
    Flight::json(Flight::symptomService()->get_symptoms_by_name($search,$offset,$limit,$order));
  }
  else{
    Flight::json(Flight::symptomService()->get_all($offset,$limit,$order));
  }

});

Flight::route("GET /symptoms/@id", function($id){
  Flight::json(Flight::symptomService()->get_by_id($id));
});

Flight::route("POST /symptoms", function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::symptomService()->add($data));
});

Flight::route("PUT /symptoms/@id",function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::symptomService()->update($data,$id));
});


 ?>
