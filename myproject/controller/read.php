<?php
/**
 * Author Vanessa Clarke <VanessaHClarke@gmail.com>
 *
 *  Read API.
 *
 * @param string $serverName Name of the server
  *@param string $dbName     Database Name
 * @param string $dbUser     Database user anme
 * @param string $dbPassword Database Password
 *
 *
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../data_access_oject/users_dao.php';

// user authentication
include_once '../controller/user_auth.php';

// instantiate database and user model
$database = new Database();
$db = $database->getConnection();

// instantiate object
$auth = new User_Auth();

// initialize object
$users = new Users_Dao($db);

if ($auth->authenticate()){


$users->user_id = $_GET["user_id"];

// query users
if ($stmt = $users->read()){

$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // users array
    $users_arr=array();
    $users_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
      extract($row);

        $user=array(
            "user_id" => $user_id,
            "email" => $email,
            "password" => $password,
            "confirm_password" => $confirm_password,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "street_number" => $street_number,
            "apartment_number" => $apartment_number,
            "street_name" => $street_name,
            "city" => $city,
            "state" => $state
        );

        array_push($users_arr["records"], $user);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode(array("message" => "user data returned successfully.","response"=>$users_arr));
}


// no products found will be here
else{
  // set response code - 404 Not found
  http_response_code(404);

  // tell the user no products found
  echo json_encode(
      array("message" => "No users found.")
  );
}
} else {
  http_response_code(500);
  echo "internal server error";
}
}

 ?>
