<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){
  header("location: login.php");
  exit;
}else{
  echo "error";
}

session_start();

session_unset();
session_destroy();
echo "destrou session";

header("location: index1.html");

exit;

?>


