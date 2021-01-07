<?php 
session_start();
require 'vendor/autoload.php' ;
if(isset($_SESSION['userName'])){
    $User = $_SESSION['userName'];
    if(isset($_SESSION['id_usuario'])){
    $id_usuario=$_SESSION['id_usuario'];
    
    }

}
    
if(!isset($style))
    $style="";

$flag = false;
$path="/grupo3/";

$flag = isset($User);
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- META CHARSET -->
    <meta charset="UTF-8">
    <!-- META VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- META DESCRIPTION -->
    <meta name="description" content="Escucha y descarga tus audios preferidos, ayuda que la comunidad crezca compartiendo las canciones 
        que más te gustan, audio libros ó entrevistas que han sido de tu agrado.">
    <!-- META KEYWORDS -->
    <meta name="keywords" content="mp3, musica, audios, audio libros, entrevista, descargar audio, descargar musica, musica mp3">
    <!-- META AUTHOR -->
    <meta name="author" content="grupo 03 tpi">
    <!-- TITLE -->
    <title>
        <?php echo $title ?>
    </title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/ico" href="public/icono/favicon_m.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/estilo.css">
    <link rel="stylesheet" href="<?= $style ?>">
    <script src="https://kit.fontawesome.com/58a3ac53d1.js" crossorigin="anonymous"></script>
</head>

<body>



    <nav class="navbar navbar-expand-lg navbar-light fixed-top " style="background-color: #81f7fb;">

        <div class="container">
            <a class="navbar-brand" href="/" id="brand"><i class="fas fa-headphones-alt" id='brand-icon'></i> AudaFreeMp3</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link " href="/">Inicio <span class="sr-only">(current)</span></a>
                    </li>

                    <?php
                if($flag){echo '
                    <li class="nav-item">
                    <a class="nav-link " href="uploadtest.php">Agregar Audios</a>
                </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Explorar
              </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="explorar.php?buscar=categorias">Categorias</a>
                        <a class="dropdown-item" href="explorar.php?buscar=generos">Generos</a>
                        <a class="dropdown-item" href="explorar.php?buscar=autores">Autores</a>
                        <a class="dropdown-item" href="administrar_listas.php">Mis Listas</a>
                        <a class="dropdown-item" href="administrar_audios.php">Mis Audios</a>
                        
                    </div>
                </li>';
                }?>

                </ul>
                <?php
                if($flag)
                echo
                '<form id="navSearch" class="form-inline my-2 my-lg-0" Action="Buscar.php" method="post">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Buscar" aria-label="Search" name="f" size="30">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                </form>';?>
                    <div class="my-2 my-lg-o ml-4">
                        <?php if($flag) echo '<a class="btn mr-1" href="">Hola, ' . $User . '</a><a class="btn btn-outline-info" href="logout.php">Salir</a>';else echo '<a id="registerA"  class="btn btn-outline-primary ml-4"href="/Register.php">Registarse</a> <a class="btn btn-outline-secondary" href="login.php">Iniciar Sesion</a>' ?></div>
            </div>
        </div>
    </nav>