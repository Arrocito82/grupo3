<?php $title="Inicio de session"; $style= 'public/css/login.css';

use Utils\Login;
use Components\Alert;

// este es el navbar
require "Components/header.php";
?>
<div class="container contenido">
  


<?php
    $flag = "";
    if(isset($_POST['userName']) & isset($_POST['password'])){
        $flag = Login::autentificar($_POST['userName'] , $_POST['password']); 
    }
    if($flag=="Logged"){
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['id_usuario']=Login::recuperar_id($_POST['userName'] , $_POST['password']);
        header("Location: index.php");
    }
    if($flag=="ErroLog"){ 
      echo Alert::SimpleAlert('Usuario o contraseña incorrectos','alert alert-danger w-50 mx-auto');
    }
?>
<form class="w-50 mx-auto" action="login.php" method="post">
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
  <div class="d-flex mt-4 LoginActions">
    <small class="mr-4"><a href="/ResetPass.php">¿Has olvidado la contraseña?</a></small>
    <button type="submit" class="btn btn-primary">Login</button>
  </div>
</form>

</div>


<?php require "Components/footer.php";?>