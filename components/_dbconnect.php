<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "users";


// connection the database
$connection = mysqli_connect($server, $username, $password, $database);
if(!$connection){
//     echo "connection is successfully";

// }else{
    die("connection is not successfully because of this error" . mysqli_connect_error);
}


?>