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

 class Database{

     // database credentials
     private $host = "localhost";
     private $db_name = "user_info";
     private $username = "root";
     private $password = "";

     public $conn;

     // get the database connection
     public function getConnection(){

         $this->conn = null;

         try{
             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
             $this->conn->exec("set names utf8");
         }catch(PDOException $exception){
             echo "Connection error: " . $exception->getMessage();
         }

         return $this->conn;
     }
 }
 ?>
