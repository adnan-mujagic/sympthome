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

 ?>
