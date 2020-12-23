<?php 
$title="Administrar Listas";
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   $user=new Usuario($_SESSION['id_usuario']);
   $listas=$user->get_listas();
    
    

   
echo "<div class='container my-5'>";
    for ($i=0; $i < count($listas) ; $i++) {
 
                 
                 echo $listas[$i]->get_nombre().$listas[$i]->get_id();


        require "Components/footer.php";       
    }}?>


    
