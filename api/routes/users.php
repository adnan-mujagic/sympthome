<?php
/**
 * @OA\Info(title="SymptHome API", version="0.2")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost:8080/api/", description="Development Environment" ),
 * )
 */


 /**
  * @OA\Get(path="/users", tags={"Users"},
  *   @OA\Parameter(type="integer",in="query",name="offset",example="0",description="Offset for pages!"),
  *   @OA\Parameter(type="integer", in="query", name="limit",example="20",description="Limit for pages!"),
  *   @OA\Parameter(type="string", in="query", name="search",description="Case insensitive search function!"),
  *   @OA\Parameter(type="string", in="query", name="order",example="-id", description ="Choose the order of your results ex. -id will return the results ordered by id, ascending!"),
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
 *@OA\Get(path="/users/{id}",tags={"Users"},
 *  @OA\Parameter(@OA\Schema(type="integer"),in="path",allowReserved=true,name="id",example=1),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */
Flight::route("GET /users/@id",function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
*@OA\Post(path="/users/register",tags={"Users"},
* @OA\RequestBody(required = true,
*   @OA\MediaType(
*     mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string",property="first_name",example="Random"),
*       @OA\Property(type="string",property="last_name",example="User"),
*       @OA\Property(type="integer",property="age",example="25"),
*       @OA\Property(type="string",property="email",example="myemail@gmail.com"),
*       @OA\Property(type="string",property="password",example="123"),
*   )
* )
*),
* @OA\Response(response="200",description="Create a new user in the database!"))
*
*/
Flight::route("POST /users/register",function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message"=>"Confirmation email has been sent to your email address! Please confirm it before you continue!"]);
});


/**
*@OA\Post(path="/users/login",tags={"Users"},
* @OA\RequestBody(required = true,
*   @OA\MediaType(
*     mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string",property="email",example="adnanmujagic@outlook.com"),
*       @OA\Property(type="string",property="password",example="verystrongpassword"),
*   )
* )
*),
* @OA\Response(response="200",description="Log In!"))
*
*/
Flight::route("POST /users/login", function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->login($data);
  Flight::json(["message"=>"Log in successful!"]);
});


/**
*@OA\Post(path="/users/forgot",tags={"Users"},
* @OA\RequestBody(required = true,
*   @OA\MediaType(
*     mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string",property="email",example="adnanmujagic@outlook.com"),
*   )
* )
*),
* @OA\Response(response="200",description="Forgot Password?"))
*
*/
Flight::route("POST /users/forgot", function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  Flight::json(["message"=>"Reset link sent!"]);
});


/**
*@OA\Put(path="/users/reset",tags={"Users"},
* @OA\RequestBody(required = true,
*   @OA\MediaType(
*     mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string",property="token",example="123"),
*       @OA\Property(type="string",property="password", example="123")
*   )
* )
*),
* @OA\Response(response="200",description="Forgot Password?"))
*
*/
Flight::route("PUT /users/reset", function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->reset($data);
  Flight::json(["message"=>"Password successfully updated."]);
});


/**
*@OA\Put(path="/users/{id}",tags={"Users"},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(property="password",example="verystrongpassword")
*   )
* )
*),
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", example=1, name="id"),
* @OA\Response(response="200",description="Update a user in the database!"))
*
*/
Flight::route("PUT /users/@id",function($id){
  $data=Flight::request()->data->getData();
  Flight::userService()->update($data,$id);
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
*@OA\Get(path="/users/{id}/symptoms",tags={"Users"},
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", example=1, name="id"),
* @OA\Response(response="200",description="Return symptoms of a user with the id in the path!"))
*
*/
Flight::route("GET /users/@id/symptoms", function($id){
  Flight::json(Flight::userService()->get_user_symptoms($id));
});


/**
*@OA\Get(path="/users/{id}/diseases",tags={"Users"},
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", example=1, name = "id"),
* @OA\Response(response="200",description="Return diseases of a user with the id in the path!"))
*
*/
Flight::route("GET /users/@id/diseases", function($id){
  Flight::json(Flight::userService()->get_user_diseases($id));
});


/**
*@OA\Put(path="/users/confirm/{token}",tags={"Users"},
* @OA\Parameter(@OA\Schema(type="string"),allowReserved=true, in="path", name ="token"),
* @OA\Response(response="200",description="Updates a user with such token to active!"))
*
*/
Flight::route("/users/confirm/@token",function($token){
  Flight::json(Flight::userService()->confirm($token));
});




 ?>
