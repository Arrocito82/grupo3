<?php 
$flag = false;
if(isset($User)) $flag=true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/estilo.css">
</head>

<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-lg-3" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown ml-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Explorar
                </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Categoria</a>
                            <a class="dropdown-item" href="#">Autor</a>
                            <a class="dropdown-item" href="#">Genero</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($User)) echo 'Hola, ' . $User;else echo '<a class="nav-link ml-lg-3" href="login.php">Iniciar Sesion</a>' ?>
                    </li>
                </ul>
                <?php
                if($flag)
                print( 
                '<form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>');?>
                <div class="my-2 my-lg-o ml-4"><?php if($flag) echo 'Hola, ' . $User;else echo '<a href="login.php">Iniciar Sesion</a><a id="registerA"  class="btn btn-primary ml-4"href="/Register.php">Registarse</a>' ?></div>
            </div>
        </div>
    </nav>