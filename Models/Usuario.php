<?php
namespace Models;
class Usuario{
    public $id , $nombre;
    public $listas=[];

    function __construct(String $id , String $nombre,array $listas){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->listas=$listas;
    }
}
?>