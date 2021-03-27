<?php
/**
*@OA\Get(path="/diseases", tags={"Diseases"},
*  @OA\Parameter(type="string", in="query", name="search",description="Search for a disease by name!"),
*  @OA\Parameter(type="integer", in="query", name="offset",description="Offset for pages!", example="0"),
*  @OA\Parameter(type="integer", in="query", name="limit",description="Limit for pages!", example="20"),
*  @OA\Parameter(type="string", in="query", name="order",description="Order results by some parameter!", example="-id"),
*  @OA\Response(response="200", description="Returns diseases from the database!")
*)
*
*/
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


/**
*@OA\Get(path="/diseases/{id}", tags={"Diseases"},
* @OA\Parameter(type="integer", in="path", name="id", example="1"),
* @OA\Response(response="200", description="Returns a specific disease by id!")
*)
*/
Flight::route("GET /diseases/@id",function($id){
  Flight::json(Flight::diseaseService()->get_by_id($id));
});


/**
*@OA\Post(path="/diseases", tags={"Diseases"},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string", property="name", example="BAD DISEASE"),
*       @OA\Property(type="string", property="description", example="VERY BAD DISEASE"),
*       @OA\Property(type="string", property="treatment_description", example="You gotta do something about this man!"),
*       @OA\Property(type="integer", property="category_id", example="2"),
*    )
*  )
* ),
* @OA\Response(response="200", description="Adding a disease to database!")
*)
*/
Flight::route("POST /diseases", function(){
  $disease = Flight::request()->data->getData();
  Flight::json(Flight::diseaseService()->add($disease));
});

/**
*@OA\Put(path="/diseases/{id}", tags={"Diseases"},
* @OA\Parameter(name="id",in="path", type="string", example="21" ),
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string", property="name", example="JUST VERY BAD DISEASE"),
*    )
*  )
* ),
* @OA\Response(response="200", description="Adding a disease to database!")
*)
*/
Flight::route("PUT /diseases/@id",function($id){
  $update=Flight::request()->data->getData();
  Flight::diseaseService()->update($update,$id);
  Flight::json(Flight::diseaseService()->get_by_id($id));
});




 ?>
