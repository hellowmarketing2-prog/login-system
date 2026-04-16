<?php
if(!isset($_SESSION)){
session_start();
}
?>

<style>

.navbar-glass{
background: rgba(20,20,20,0.85);
backdrop-filter: blur(8px);
box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.logo{
font-weight:700;
font-size:20px;
background: linear-gradient(45deg,#00f2fe,#4facfe);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.nav-link{
color:#eee !important;
margin-right:10px;
transition:0.3s;
}

.nav-link:hover{
color:#00f2fe !important;
}

.nav-btn{
border-radius:20px;
padding:5px 15px;
}

.user-badge{
background:#ffc107;
color:#000;
border-radius:20px;
padding:5px 12px;
font-weight:600;
}

</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-glass sticky-top">

<div class="container">

<a class="navbar-brand logo" href="#">
⚡ My website
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link" href="/login-system/index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">About</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#">Contact</a>
</li>

</ul>

<ul class="navbar-nav align-items-center">

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

echo '

<li class="nav-item">
<span class="user-badge me-2">👋 '.$_SESSION['username'].'</span>
</li>

<li class="nav-item">
<a class="btn btn-danger btn-sm nav-btn" href="/login-system/logout.php">Logout</a>
</li>

';

}
else{

echo '

<li class="nav-item">
<a class="btn btn-outline-light btn-sm nav-btn me-2" href="/login-system/login.php">Login</a>
</li>

<li class="nav-item">
<a class="btn btn-info btn-sm nav-btn" href="signup1.php">Sign Up</a>
</li>

';

}

?>

</ul>

</div>
</div>

</nav>