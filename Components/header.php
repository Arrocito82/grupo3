<?php 
session_start();
require 'vendor/autoload.php' ;
if(isset($_SESSION['userName']))
    $User = $_SESSION['userName'];

$flag = false;
$path="/grupo3/";
if(isset($User))
    $flag=true;
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
            <a class="navbar-brand" href="<?php echo $path; ?>">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-lg-3" href="<?php echo $path; ?>">Inicio <span class="sr-only">(current)</span></a>
                    </li>

                    <?php
                if($flag){print('
                    <li class="nav-item dropdown ml-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Explorar
                </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="explorar.php?buscar=categoria">Categoria</a>
                            <a class="dropdown-item" href="explorar.php?buscar=autor">Autor</a>
                            <a class="dropdown-item" href="explorar.php?buscar=genero">Genero</a>
                        </div>
                    </li>');
                }?>
                    
                </ul>
                <?php
                if($flag)
                print( 
                '<form class="form-inline my-2 my-lg-0" Action="'.$path.'explorar.php" method="get">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="buscar" size="40">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>');?>
                <div class="my-2 my-lg-o ml-4"><?php if($flag) echo '<a class="btn mr-1" href="">Hola, ' . $User . '</a><a class="btn btn-outline-secondary" href="logout.php">Salir</a>';else echo '<a id="registerA"  class="btn btn-outline-primary ml-4"href="/Register.php">Registarse</a> <a class="btn btn-outline-secondary" href="login.php">Iniciar Sesion</a>' ?></div>
            </div>
        </div>
    </nav>
    