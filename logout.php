<?php
session_start();

session_unset();
session_destroy();
echo "destrou session";

header("location: login.php");

exit;
?>