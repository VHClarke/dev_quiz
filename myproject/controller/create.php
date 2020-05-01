<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// user authentication
include_once '../controller/user_auth.php';

// instantiate data access object
include_once '../data_access_oject/users_dao.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$users = new Users_Dao($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// instantiate object
$auth = new User_Auth();

// initialize object
if ($auth->authenticate()){

// make sure data is not empty
if(
    !empty($data->email) &&
    !empty($data->password) &&
    !empty($data->confirm_password) &&
    !empty($data->first_name) &&
    !empty($data->last_name) &&
    !empty($data->street_number) &&
    !empty($data->apartment_number) &&
    !empty($data->street_name) &&
    !empty($data->city) &&
    !empty($data->state)
){
  // set users property values
  $users->email            = $data->email;
  $users->password         = $data->password;
  $users->confirm_password = $data->confirm_password;
  $users->first_name       = $data->first_name;
  $users->last_name        = $data->last_name;
  $users->street_number    = $data->street_number;
  $users->apartment_number = $data->apartment_number;
  $users->street_name      = $data->street_name;
  $users->city             = $data->city;
  $users->state            = $data->state;

  // set response code

  // create the user
    if($users->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "User was created."));
    }

    // if unable to create the user, tell the user
    else{

        // set response code - 500 service unavailable
        http_response_code(500);


        // tell the user
        echo json_encode(array("message" => " internal server error"));
    }
    // tell the user data is incomplete
}else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
 }
}
?>
