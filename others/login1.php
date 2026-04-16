<?php 
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'components/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
   
    $sql = "select * from users where username='$username' AND password='$password'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: when/index.html");
    }
    else{
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    height:100vh;
}

.login-card{
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.form-control{
    border-radius:10px;
}

.btn-primary{
    border-radius:10px;
}

</style>

</head>

<body>

<?php require '_nav1.php'; ?>

<?php 
if($login){
echo '
<div class="position-fixed top-0 start-50 translate-middle-x mt-5" style="z-index:1055; width:400px;">
<div class="alert alert-success alert-dismissible fade show shadow" role="alert">
<strong>Success!</strong> Your account is now created and you can login.
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
</div>
';
}
?>

<?php 
if($showError){
echo '
<div class="position-fixed top-0 start-50 translate-middle-x mt-5" style="z-index:1055; width:400px;">
<div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
<strong>Error!</strong> '.$showError.'
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
</div>
';
}
?>

<div class="container d-flex justify-content-center align-items-center" style="height:80vh;">

<div class="card login-card p-4 col-md-5">

<h3 class="text-center mb-4">Login to Your Account</h3>

<form action="/login-system/login1.php" method="post">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" class="form-control" name="username" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password" required>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-primary">Login</button>
</div>

</form>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>

const toastElList = [].slice.call(document.querySelectorAll('.toast'))

toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl, { delay: 2000 }).show()
})

</script>
</body>
</html>