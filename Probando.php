
<?php
use Repositories\AutorRepo;
use Repositories\GeneroRepo;
use Repositories\CategoriaRepo;
use Repositories\AudioRepo;
use Repositories\ListasRepo;
//require "Components/header.php";
require 'vendor/autoload.php' ;

echo "<br>";
$id_busqueda='5fd6b9634a120000b90015a3';
$query=['id_categoria'=>['$in'=>[$id_busqueda]]];
/*
for ($i=25; $i < 30; $i++) { 
    $audio=AudioRepo::CrearAudio(
        'url',
        'tituloprueba'.$i,
        '5fd560550ce1912de8f799cd',
    ['5fd8297480bef9c12bf5149e'],
    ['5fef8f1ab883756d8ad0d3c3','5fdbd81ba2aa16d0b4bc65f6'],
    ['5fd563ab0ce1912de8f799d1']
    );
    echo var_dump($audio);
    
}*/
// $audios=AudioRepo::ObtenerAudiosFiltro(["categorias.id"=>['$in'=>['5fef8f1ab883756d8ad0d3c3']]]);
// foreach ($audios as $key ) {
//     $value=$key['categorias'];
//     foreach ($value as $k) {
//        echo var_dump($k);
//     }
// }
$limite=5;$target='categorias';$id_busqueda='5fef8f1ab883756d8ad0d3c3';
$query=[
    $target.'.id'=>[
                        '$in'=>[$id_busqueda]
                    ]    
    ];


$opciones=[
            'limit' =>$limite
     ];
$tmp=AudioRepo::ObtenerAudiosFiltro($query,$opciones);
echo var_dump(json_encode($tmp));


?>


