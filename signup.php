<?php 
$showalart = false;
$showerror = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'components/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // cheking wether this username is exist
    $existsql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($connection, $existsql);
    $numExistRow = mysqli_num_rows($result);
    if($numExistRow > 0){
        
        $showerror = "Username is alredy Exist use different username";

    }
    else{
        if(($password == $cpassword)){

            // creating hash
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($connection, $sql);
            if($result){
                $showalart = true;

            }

    }
    else{
            $showerror = "Passwords do no match";
        }
  }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
<?php require 'components/_nav.php'; ?>
<?php 
if($showalart){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your accound is now created and you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<?php 
if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showerror .' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
    <div class="container my-4">

        <h1 class="text-center">SignUp to our website</h1>
        <form action="/login-system/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="11" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="11" class="form-control" id="cpassword"  name="cpassword">
                <small id="emailHelp" class="form-text">Make sure to type the same password.</small>
            </div>
            
            <button type="submit" class="btn btn-primary col-md-3">Sign Up</button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>