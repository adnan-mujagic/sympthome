<?php

/**
*@OA\Get(path="/bodyparts", tags={"Body Parts"},
* @OA\Parameter(type="string", in="query", name="search", description="Search functionality!"),
* @OA\Parameter(type="integer", in="query", name="offset", description="Offset functionality!", example="0"),
* @OA\Parameter(type="integer", in="query", name="limit", description="Limit functionality!", example="20"),
* @OA\Parameter(type="string", in="query", name="order", description="Order functionality!", example="-id"),
* @OA\Response(response="200", description="Returns body parts that have some kind of diseas related to them!")
*)
*/
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

/**
*@OA\Get(path="/bodyparts/{id}", tags={"Body Parts"},
* @OA\Parameter(type="integer",in="path", name="id", example="1"),
* @OA\Response(response="200", description="Return body part by id!")
*)
*/
  Flight::route("GET /bodyparts/@id", function($id){
    Flight::json(Flight::bodyPartService()->get_by_id($id));
  });

/**
*@OA\Post(path="/bodyparts", tags={"Body Parts"},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string", property="name", example="Ankle"),
*  )
* )
*),
* @OA\Response(response="200", description="Add body part to the database!")
*)
*/
  Flight::route("POST /bodyparts", function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bodyPartService()->add($data));
  });

  /**
  *@OA\Put(path="/bodyparts/{id}", tags={"Body Parts"},
  * @OA\Parameter(type="integer", in="path", name="id", example="1"),
  * @OA\RequestBody(required=true,
  *   @OA\MediaType(mediaType="application/json",
  *     @OA\Schema(
  *       @OA\Property(type="string", property="name", example="Throat"),
  *  )
  * )
  *),
  * @OA\Response(response="200", description="Update body part in the database!")
  *)
  */
  Flight::route("PUT /bodyparts/@id", function($id){
    $data = Flight::request()->data->getData();
    $bp=Flight::bodyPartService()->update($data,$id);
    Flight::json(Flight::bodyPartService()->get_by_id($bp["id"]));
  });


/**
*@OA\Get(path="/bodyparts/{id}/diseases", tags={"Body Parts"},
* @OA\Parameter(type="integer", in="path", name="id", example="1"),
* @OA\Parameter(type="integer", in="query", name="offset", example="0"),
* @OA\Parameter(type="integer", in="query", name="limit", example="20"),
* @OA\Parameter(type="string", in="query", name="order", example="-id"),
* @OA\Response(response="200", description="Return all diseases related to pain in a specific body part!")
*)
*/
  Flight::route("GET /bodyparts/@id/diseases", function($id){
    $offset = Flight::query("offset",0);
    $limit = Flight::query("limit",10);
    $order = Flight::query("order","-id");
    Flight::json(Flight::bodyPartService()->get_bodypart_diseases($id,$offset,$limit,$order));
  })

 ?>
