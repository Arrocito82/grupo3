<?php

$title="Inicio";
// este es el navbar
session_start();

if(isset($_SESSION['userName']))
    Header("Location: index.php");

require "Components/header.php";
?>
<?php 
     if(isset($_POST['userName']) & isset($_POST['password']) & isset($_POST['password'])){
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $email = $_POST['email'];
     }
?>
<div class="container w-50 mt-5">

    <form action="login.php" method="post">
    <div class="form-group">
        <label for="userName">User</label>
        <input type="text" class="form-control" name="userName" id="userName" aria-describedby="userHelp" placeholder="Enter user" required>
        <small id="userHelp" class="form-text text-muted">Nombre de usuario en la web</small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="userHelp" placeholder="Enter user" required>
        <small id="userHelp" class="form-text text-muted">Se enviara una clave de verificacion</small>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>



<script>
document.getElementById("registerA").style.display ="none";
</script>
<?php require "Components/footer.php";?>