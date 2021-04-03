<?php
/**
 * @OA\Get(path="/admin/symptoms", tags={"Symptoms","Admin"},security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer",in="query",name="offset",example="0",description="Offset for pages!"),
 *   @OA\Parameter(type="integer", in="query", name="limit",example="20",description="Limit for pages!"),
 *   @OA\Parameter(type="string", in="query", name="search",description="Case insensitive search function!"),
 *   @OA\Parameter(type="string", in="query", name="order",example="-id", description ="Choose the order of your results ex. -id will return the results ordered by id, ascending!"),
 *   @OA\Response(response="200", description="List users from database!")
 *
 * )
 */
Flight::route("GET /admin/symptoms", function(){
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



/**
 *@OA\Get(path="/admin/symptoms/{id}",tags={"Symptoms","Admin"},security={{"ApiKeyAuth": {}}},
 *  @OA\Parameter(@OA\Schema(type="integer"),in="path",allowReserved=true,name="id",example=1),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */

Flight::route("GET /admin/symptoms/@id", function($id){
  Flight::json(Flight::symptomService()->get_by_id($id));
});

/**
 *@OA\Post(path="/admin/symptoms",tags={"Symptoms"},security={{"ApiKeyAuth": {}}},
 *  @OA\RequestBody(required=true,
 *    @OA\MediaType(mediaType="application/json",
 *      @OA\Schema(
 *        @OA\Property(type="string", property="name", example="Example")
 *    )
 *  )
 *),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */
Flight::route("POST /admin/symptoms", function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::symptomService()->add_symptom($data));
});

/**
 *@OA\Put(path="/admin/symptoms/{id}",tags={"Symptoms"},security={{"ApiKeyAuth": {}}},
 *  @OA\RequestBody(required=true,
 *    @OA\MediaType(mediaType="application/json",
 *      @OA\Schema(
 *        @OA\Property(type="string", property="name", example="Example")
 *    )
 *  )
 *),
 *  @OA\Parameter(name="id",type="integer",in="path",example="12"),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */
Flight::route("PUT /admin/symptoms/@id",function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::symptomService()->update($data,$id));
});


 ?>
