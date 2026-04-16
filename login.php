<?php
session_start();
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){
//   header("location: signup.php");
//   exit;
// }
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'components/_dbconnect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();

        }else{
            $showError = "Invalid credentials";
        }

    }else{
        $showError = "Invalid credentials";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
<?php require 'components/_nav.php'; ?>
<?php 

if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your accound is now created and you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<?php 
if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError .' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
    <div class="container my-4">

        <h1 class="text-center">Login to our website</h1>
        <form action="login.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="11" class="form-control" name="password" id="password">
            </div>
          
            
            <button type="submit" class="btn btn-primary col-md-3">Log in</button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>