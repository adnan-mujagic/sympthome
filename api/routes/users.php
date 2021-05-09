<?php
/**
 * @OA\Info(title="SymptHome API", version="0.2")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost:8080/api/", description="Development Environment" ),
 *    @OA\Server(url="sympthome-tvldx.ondigitalocean.app/api/", description="Production Environment" ),
 * ),
 * @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication" )
 */


 /**
  * @OA\Get(path="/admin/users", tags={"Users", "Admin"},security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(type="integer",in="query",name="offset",example="0",description="Offset for pages!"),
  *   @OA\Parameter(type="integer", in="query", name="limit",example="20",description="Limit for pages!"),
  *   @OA\Parameter(type="string", in="query", name="search",description="Case insensitive search function!"),
  *   @OA\Parameter(type="string", in="query", name="order",example="-id", description ="Choose the order of your results ex. -id will return the results ordered by id, ascending!"),
  *   @OA\Response(response="200", description="List users from database!")
  *
  * )
  */
Flight::route("GET /admin/users",function(){

  //Flight::json(Flight::user()->get_all());

  $limit = Flight::query("limit",10);
  $offset = Flight::query("offset",0);
  $search = Flight::query("search");
  $order = Flight::query("order","-id");

  Flight::json(Flight::userService()->get_users($search,$offset,$limit,$order));
});

/**
 *@OA\Get(path="/users",tags={"Users"},security={{"ApiKeyAuth": {}}},
 *  @OA\Response(response="200", description="Returns logged in users account!"),
 *)
 */
Flight::route("GET /users",function(){
  Flight::json(Flight::userService()->get_by_id(Flight::get("user")["id"]));
});

/**
 *@OA\Get(path="/admin/users/{id}",tags={"Users", "Admin"},security={{"ApiKeyAuth": {}}},
 *  @OA\Parameter(@OA\Schema(type="integer"),in="path",allowReserved=true,name="id",example=1),
 *  @OA\Response(response="200", description="Returns account by id!"),
 *)
 */
Flight::route("GET /admin/users/@id",function($id){
    Flight::json(Flight::userService()->get_by_id($id));
});

/**
*@OA\Post(path="/register",tags={"Users"},
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
Flight::route("POST /register",function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message"=>"Confirmation email has been sent to your email address! Please confirm it before you continue!"]);
});


/**
*@OA\Post(path="/login",tags={"Users"},
* @OA\RequestBody(required = true,
*   @OA\MediaType(
*     mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(type="string",property="email",example="adnanmujagic@outlook.com"),
*       @OA\Property(type="string",property="password",example="123"),
*   )
* )
*),
* @OA\Response(response="200",description="Log In!"))
*
*/
Flight::route("POST /login", function(){
  $data=Flight::request()->data->getData();
  $user = Flight::userService()->login($data);
  Flight::json(["token"=>Flight::jwt($user)]);
});


/**
*@OA\Post(path="/forgot",tags={"Users"},
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
Flight::route("POST /forgot", function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  Flight::json(["message"=>"Link for your password recovery has been sent to your email address!"]);
});


/**
*@OA\Put(path="/reset",tags={"Users"},
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
Flight::route("PUT /reset", function(){
  $data = Flight::request()->data->getData();
  $user = Flight::userService()->reset($data);
  Flight::json(["token"=>Flight::jwt($user)]);
});

/**
*@OA\Put(path="/confirm/{token}",tags={"Users"},
* @OA\Parameter(@OA\Schema(type="string"),allowReserved=true, in="path", name ="token"),
* @OA\Response(response="200",description="Updates a user with such token to active!"))
*
*/
Flight::route("/confirm/@token",function($token){
  $user=Flight::userService()->confirm($token);
  Flight::json(["token"=>Flight::jwt($user)]);
});


/**
*@OA\Put(path="/users",tags={"Users"},security={{"ApiKeyAuth": {}}},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(property="password",example="verystrongpassword")
*   )
* )
*),
* @OA\Response(response="200",description="Update a logged in user in the database!"))
*
*/
Flight::route("PUT /users",function(){
  $data=Flight::request()->data->getData();
  Flight::userService()->update($data,Flight::get("user")["id"]);
  Flight::json(Flight::userService()->get_by_id(Flight::get("user")["id"]));
});

/**
*@OA\Put(path="/admin/users/{id}",tags={"Users", "Admin"},security={{"ApiKeyAuth": {}}},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(property="password",example="verystrongpassword")
*   )
* )
*),
* @OA\Parameter(@OA\Schema(type="integer"),allowReserved=true, in="path", example=1, name="id"),
* @OA\Response(response="200",description="Update any user in the database!"))
*
*/
Flight::route("PUT /admin/users/@id",function($id){
  $data=Flight::request()->data->getData();
  Flight::userService()->update($data,$id);
  Flight::json(Flight::userService()->get_by_id($id));
});




/**
*@OA\Get(path="/admin/users/{id}/symptoms",tags={"Users","Admin"},security={{"ApiKeyAuth": {}}},
* @OA\Parameter(type="integer", in="path", name="id", example="1"),
* @OA\Parameter(type="string", in="query", name="search", description="Search functionality!"),
* @OA\Parameter(type="integer", in="query", name="offset", example="0"),
* @OA\Parameter(type="integer", in="query", name="limit", example="20"),
* @OA\Parameter(type="string", in="query", name="order", example="-id"),
* @OA\Response(response="200",description="Return symptoms of any user!"))
*
*/
Flight::route("GET /admin/users/@id/symptoms", function($id){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",10);
  $order = Flight::query("order","-id");
  Flight::json(Flight::symptomService()->get_user_symptoms($id,$offset, $limit,$order, $search));
});




/**
*@OA\Get(path="/admin/users/{id}/diseases",tags={"Users","Admin"},security={{"ApiKeyAuth": {}}},
* @OA\Parameter(type="integer", in="path", name="id", example="1"),
* @OA\Parameter(type="string", in="query", name="search", description="Search functionality!"),
* @OA\Parameter(type="integer", in="query", name="offset", example="0"),
* @OA\Parameter(type="integer", in="query", name="limit", example="20"),
* @OA\Parameter(type="string", in="query", name="order", example="-id"),
* @OA\Response(response="200",description="Return diseases of any user!"))
*
*/
Flight::route("GET /admin/users/@id/diseases", function($id){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",10);
  $order = Flight::query("order","-id");
  Flight::json(Flight::diseaseService()->get_user_diseases($id,$offset, $limit,$order, $search));
});




/**
*@OA\Get(path="/admin/users/{id}/medicines",tags={"Users", "Admin"},security={{"ApiKeyAuth": {}}},
* @OA\Parameter(type="integer", in="path", name="id", example="1"),
* @OA\Parameter(type="string", in="query", name="search", description="Search functionality!"),
* @OA\Parameter(type="integer", in="query", name="offset", example="0"),
* @OA\Parameter(type="integer", in="query", name="limit", example="20"),
* @OA\Parameter(type="string", in="query", name="order", example="-id"),
* @OA\Response(response="200",description="Return medicines of any user!"))
*
*/
Flight::route("GET /admin/users/@id/medicines", function($id){
  $search = Flight::query("search");
  $offset = Flight::query("offset",0);
  $limit = Flight::query("limit",10);
  $order = Flight::query("order","-id");
  Flight::json(Flight::medicineService()->get_user_medicines($id,$offset, $limit,$order, $search));
});

/**
* @OA\Post(path="/users/symptoms",tags={"Users"},security={{"ApiKeyAuth": {}}},
* @OA\RequestBody(required=true,
*   @OA\MediaType(mediaType="application/json",
*     @OA\Schema(
*       @OA\Property(property="symptom_id",example="1"),
*   )
* )
*),
* @OA\Response(response="200",description="Update a logged in user in the database!")
*)
*/
Flight::route("POST /users/symptoms",function(){
  Flight::json(Flight::userService()->add_symptom(Flight::request()->data->getData()));
})


 ?>
