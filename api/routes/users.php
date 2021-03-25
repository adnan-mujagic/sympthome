<?php
/**
 * @OA\Info(title="SymptHome API", version="0.2")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost:8080/api/", description="Development Environment" ),
 * )
 */


 /**
  * @OA\Get(path="/users",
  *   @OA\Response(response="200", description="List users from database!")
  *
  * )
  */
Flight::route("GET /users",function(){

  //Flight::json(Flight::user()->get_all());

  $limit = Flight::query("limit",10);
  $offset = Flight::query("offset",0);
  $search = Flight::query("search");
  $order = Flight::query("order","-id");

  Flight::json(Flight::userService()->get_users($search,$offset,$limit,$order));
});

/**
 *@OA\Get(path="/users/{id}",
 *  @OA\Parameter(@OA\Schema(type="integer"),in="path",allowReserved=true,name="id",default=1),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */
Flight::route("GET /users/@id",function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
*@OA\Post(path="/users/register",
* @OA\Response(response="200",description="Create a new user in the database!"))
*
*/
Flight::route("POST /users/register",function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->register($data));
});


/**
*@OA\Put(path="/users/{id}",
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", default=1, name="id"),
* @OA\Response(response="200",description="Update a user in the database!"))
*
*/
Flight::route("PUT /users/@id",function($id){
  $data=Flight::request()->data->getData();
  Flight::userService()->update($data,$id);
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
*@OA\Get(path="/users/{id}/symptoms",
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", default=1, name="id"),
* @OA\Response(response="200",description="Return symptoms of a user with the id in the path!"))
*
*/
Flight::route("GET /users/@id/symptoms", function($id){
  Flight::json(Flight::userService()->get_user_symptoms($id));
});


/**
*@OA\Get(path="/users/{id}/diseases",
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", default=1, name = "id"),
* @OA\Response(response="200",description="Return diseases of a user with the id in the path!"))
*
*/
Flight::route("GET /users/@id/diseases", function($id){
  Flight::json(Flight::userService()->get_user_diseases($id));
});


/**
*@OA\Put(path="/users/confirm/{token}",
* @OA\Parameter(@OA\Schema(type="string"),allowReserved=true, in="path", name ="token"),
* @OA\Response(response="200",description="Updates a user with such token to active!"))
*
*/
Flight::route("PUT /users/confirm/@token",function($token){
  Flight::json(Flight::userService()->confirm($token));
});


 ?>
