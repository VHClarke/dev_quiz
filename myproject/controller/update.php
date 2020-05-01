<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

echo $_SERVER['SERVER_NAME'];

// include database and object files
include_once '../config/database.php';
include_once '../data_access_oject/users_dao.php';

// user authentication
include_once '../controller/user_auth.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$users = new Users_Dao($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// instantiate object
$auth = new User_Auth();

// set ID property of user to be edited
$users->user_id = $data->user_id;

// set product property values
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

// update the product

if ($auth->authenticate()){

if($users->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "User was updated."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update users."));
 }
}
?>
