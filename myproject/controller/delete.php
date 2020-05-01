<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../data_access_oject/users_dao.php';

// user authentication
include_once '../controller/user_auth.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$users = new Users_Dao($db);

// get user id
$data = json_decode(file_get_contents("php://input"));

// instantiate object
$auth = new User_Auth();

// set user id to be deleted
$users->user_id = $data->user_id;

if ($auth->authenticate()){

// delete the user
if($users->delete()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "User was deleted."));
}

// if unable to delete the product
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete User."));
}

}
?>
