<?php 
$showalart = false;
$showerror = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'components/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existsql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($connection, $existsql);
    $numExistRow = mysqli_num_rows($result);

    if($numExistRow > 0){
        $showerror = "Username is alredy Exist use different username";
    }
    else{
        if(($password == $cpassword)){
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
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
<title>Signup</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    height:100vh;
}

.signup-card{
    border:none;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
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

<?php include 'components/_nav.php'; ?>

<?php 
if($showalart){
echo '
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
  <div id="signupSuccess" class="toast align-items-center text-bg-success border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        ✅ Account created successfully! Now you can login.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
';
}
?>

<?php 
if($showerror){
echo '
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
  <div id="signupError" class="toast align-items-center text-bg-danger border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        ❌ '.$showerror.'
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
';
}
?>

<div class="container d-flex justify-content-center align-items-center" style="height:80vh;">

<div class="card signup-card p-4 col-md-5">

<h3 class="text-center mb-4">Create Your Account</h3>

<form action="/login-system/signup1.php" method="post">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" class="form-control" name="username" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password" required>
</div>

<div class="mb-3">
<label class="form-label">Confirm Password</label>
<input type="password" class="form-control" name="cpassword" required>
<small class="text-muted">Make sure to type the same password.</small>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-primary">Sign Up</button>
</div>

</form>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>

const toastElList = [].slice.call(document.querySelectorAll('.toast'))

toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl, { delay: 2000 }).show()
})

</script>
</body>
</html>