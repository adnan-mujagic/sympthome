<?php
Flight::route("GET /symptoms", function(){
  $search = Flight::query("search");
  if($search){
    Flight::json(Flight::symptomService()->get_symptoms_by_name($search));
  }
  else{
    Flight::json(Flight::symptomService()->get_all());
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
