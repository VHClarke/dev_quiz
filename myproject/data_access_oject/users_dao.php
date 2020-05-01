<?php
/**
 * Author Vanessa Clarke <VanessaHClarke@gmail.com>
 *
 * Connection to mySQL datbase.
 *
 * @var string $serverName Name of the server
 * @var string $dbName     Name of the database
 * @var string $dbUser     Database user name
 * @var string $dbPassword Database Password
 *
 *
 */
class Users_Dao{

    // database connection and
    private $conn;


    // object properties
    public $user_id;
    public $email;
    public $password;
    public $confirm_password;
    public $first_name;
    public $last_name;
    public $street_number;
    public $apartment_number;
    public $street_name;
    public $city;
    public $state;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read model
function read(){

    // select all query
    $query = "SELECT
                    user_id,
                    email,
                    password,
                    confirm_password,
                    first_name,
                    last_name,
                    street_number,
                    apartment_number,
                    street_name,
                    city,
                    state
              FROM `users_table`
              WHERE user_id = $this->user_id
              ORDER BY user_id ASC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
  if  ($stmt->execute()) {
    return $stmt;
  }

    return false;
  }

  // create product
function create(){

  $query = "INSERT INTO
            `users_table`
                        (`email`,
                         `password`,
                         `confirm_password`,
                         `first_name`,
                         `last_name`,
                         `street_number`,
                         `apartment_number`,
                         `street_name`,
                         `city`,
                         `state`)
            VALUES
            ('$this->email','$this->password','$this->confirm_password','$this->first_name','$this->last_name',$this->street_number,$this->apartment_number,'$this->street_name','$this->city','$this->state')";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize data
    $this->email            =htmlspecialchars(strip_tags($this->email));
    $this->password         = htmlspecialchars(strip_tags($this->password));
    $this->confirm_password =htmlspecialchars(strip_tags($this->confirm_password));
    $this->first_name       =htmlspecialchars(strip_tags($this->first_name));
    $this->last_name        =htmlspecialchars(strip_tags($this->last_name));
    $this->street_number    =htmlspecialchars(strip_tags($this->street_number));
    $this->apartment_number =htmlspecialchars(strip_tags($this->apartment_number));
    $this->street_name      =htmlspecialchars(strip_tags($this->street_name));
    $this->city             =htmlspecialchars(strip_tags($this->city));
    $this->state            =htmlspecialchars(strip_tags($this->state));

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}

// delete the product
function delete(){

    // delete query
    $query = "DELETE FROM `users_table` WHERE user_id = $this->user_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));

    //bind id of record to delete
    $stmt->bindParam(1, $this->user_id);

    // execute query
    if($stmt->execute()){
    ;
        return true;
    }

    return false;
}
// update the product
function update(){

    // update query
    $query = "UPDATE `users_table`
              SET
                email            = '$this->email',
                password         = '$this->password',
                confirm_password = '$this->confirm_password',
                first_name       = '$this->first_name',
                last_name        = '$this->last_name',
                street_number    = '$this->street_number',
                apartment_number = '$this->apartment_number',
                street_name      = '$this->street_name',
                city             = '$this->city',
                state            = '$this->state'

            WHERE
                 $this->user_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->confirm_password=htmlspecialchars(strip_tags($this->confirm_password));
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->street_number=htmlspecialchars(strip_tags($this->apartment_number));
    $this->street_number=htmlspecialchars(strip_tags($this->street_name));
    $this->street_number=htmlspecialchars(strip_tags($this->city));
    $this->street_number=htmlspecialchars(strip_tags($this->state));

    // bind new values
    // $stmt->bindParam(':name', $this->name);
    // $stmt->bindParam(':price', $this->price);
    // $stmt->bindParam(':description', $this->description);
    // $stmt->bindParam(':category_id', $this->category_id);
    // $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}

}

 ?>
