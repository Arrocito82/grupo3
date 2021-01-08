<?php 
require '../vendor/autoload.php' ;
require "clases.php";

use MongoDB\Client as db;


$andrea=new Usuario('5fd560550ce1912de8f799cd');

// echo var_dump($andrea->get_listas()[0]);
echo var_dump($andrea->get_listas()[0]);
?>
