<?php

Flight::route("GET /diseases",function(){
  $search = Flight::query('search');
  $offset = Flight::query('offset',0);
  $limit = Flight::query('limit',10);
  $order = Flight::query('order',"-id");

  if($search){
    Flight::json(Flight::diseaseService()->get_diseases_by_name($search,$offset,$limit,$order));
  }
  else{
    Flight::json(Flight::diseaseService()->get_all($offset,$limit,$order));
  }
});

Flight::route("GET /diseases/@id",function($id){
  Flight::json(Flight::diseaseService()->get_by_id($id));
});

Flight::route("POST /diseases", function(){
  $disease = Flight::request()->data->getData();
  Flight::json(Flight::diseaseService()->add($disease));
});

Flight::route("PUT /diseases/@id",function($id){
  $update=Flight::request()->data->getData();
  Flight::diseaseService()->update($update,$id);
  Flight::json(Flight::diseaseService()->get_by_id($id));
});




 ?>
