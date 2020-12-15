<?php $title="Inicio de session";
session_start();
use Utils\Login;
require 'vendor/autoload.php' ;
// este es el navbar
require "Components/header.php";
//require "Utils/Authentication.php";
?>
<div class="container">
<?php
    $flag = "";
    if(isset($_POST['userName']) & isset($_POST['password'])){
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $flag = Login::autentificar($userName , $password); 
       
    }
    if($flag=="Logged"){
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['password'] = $_POST['password'];
        header("Location: index.php");
    }
    if($flag=="ErroLog"){
      printf('<div class="alert alert-danger mt-5" role="alert">
      Nombre y/o contraseña incorrectos
      </div><hr>');
    }
?>
<form action="login.php" method="post">
  <div class="form-group">
    <label for="c">User</label>
    <input type="tex" class="form-control" name="userName" id="userName" aria-describedby="userHelp" placeholder="Enter user" required>
    <small id="userHelp" class="form-text text-muted">We'll never share your user with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>

</div>

<?php require "Components/footer.php";?>