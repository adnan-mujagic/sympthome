<?php
//ROUTES FOR MEDICINES

/**
*@OA\Get(path="/medicines", tags={"Medicines"},
*   @OA\Parameter(type="string", in="query",name="search",description="Search functionality!"),
*   @OA\Parameter(type="integer", in="query",name="offset",description="Offset for pages!", example="0"),
*   @OA\Parameter(type="integer", in="query",name="limit",description="Limit for pages", example="20"),
*   @OA\Parameter(type="string", in="query",name="order",description="Order the results!", example="-id"),
*   @OA\Response(response="200", description="List medicines from the database!")
*)
*/

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

/**
*@OA\Get(path="/medicines/{id}", tags={"Medicines"},
* @OA\Parameter(type="string", name="id", in="path", example="1"),
* @OA\Response(response="200", description="Get medicine by id!")
*)
*
*/
Flight::route("GET /medicines/@id",function($id){
  Flight::json(Flight::medicineService()->get_by_id($id));
});


/**
* @OA\Post(path="/admin/medicines", tags={"Medicines", "Admin"},security={{"ApiKeyAuth": {}}},
*   @OA\RequestBody(required=true,
*     @OA\MediaType(mediaType="application/json",
*       @OA\Schema(
*         @OA\Property(type="string", property="name", example="Ducray HIDROSIS CONTROL"),
*         @OA\Property(type="string", property="instruction", example="Medicine that helps with itch and inflamation of skin!"),
*         @OA\Property(type="string", property="warning", example="Do not use more than once per day!"),
*         @OA\Property(type="string", property="side_effects", example="-"),
*         @OA\Property(type="string", property="requires_prescription", example="0"),
*     )
*   )
* ),
* @OA\Response(response="200", description="Adds a medicine to the database!")
*)
*/
Flight::route("POST /admin/medicines",function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->add_medicine($data));
});


/**
* @OA\Post(path="/admin/medicines/{id}/diseases", tags={"Medicines","Admin"},security={{"ApiKeyAuth": {}}},
*   @OA\Parameter(type="integer",in="path", name="id", example="5", description="Id of the medicine we want to relate to some disease!"),
*   @OA\RequestBody(required=true,
*     @OA\MediaType(mediaType="application/json",
*       @OA\Schema(
*         @OA\Property(type="string", property="disease_id", example="1"),
*     )
*   )
* ),
* @OA\Response(response="200", description="Add disease related to a medicine with the specific id!")
*)
*/
Flight::route("POST /admin/medicines/@id/diseases",function($id){
  $data = Flight::request()->data->getData();
  $data["medicine_id"]=$id;
  Flight::json(Flight::medicineService()->add_disease_for_medicine($data));
});

/**
* @OA\Put(path="/admin/medicines/{id}", tags={"Medicines","Admin"},security={{"ApiKeyAuth": {}}},
*   @OA\Parameter(type="integer",in="path", name="id", example="5", description="Id of the medicine we want to apply changes to!"),
*   @OA\RequestBody(required=true,
*     @OA\MediaType(mediaType="application/json",
*       @OA\Schema(
*         @OA\Property(type="string", property="requires_prescription", example="1"),
*     )
*   )
* ),
* @OA\Response(response="200", description="Apply changes to a medicine with the specific id!")
*)
*/
Flight::route("PUT /admin/medicines/@id",function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::medicineService()->update($data,$id));
});

/**
*@OA\Get(path="/users/medicines",tags={"Medicines","Users"},security={{"ApiKeyAuth": {}}},
*   @OA\Parameter(type="integer",in="query",name="offset",example="0",description="Offset for pages!"),
*   @OA\Parameter(type="integer", in="query", name="limit",example="20",description="Limit for pages!"),
*   @OA\Parameter(type="string", in="query", name="search",description="Case insensitive search function!"),
*   @OA\Parameter(type="string", in="query", name="order",example="-id", description ="Choose the order of your results ex. -id will return the results ordered by id, ascending!"),
* @OA\Response(response="200",description="Return medicines of a logged in user!"))
*
*/
Flight::route("GET /users/medicines", function(){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",20);
  $order = Flight::query("order","-id");
  Flight::json(Flight::medicineService()->get_user_medicines(Flight::get("user")["id"],$offset, $limit,$order, $search));
});



 ?>
