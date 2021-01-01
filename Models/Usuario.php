<?php
namespace Models;
class Usuario{
    public $_id , $nombre;
    public $listas=[];

    function __construct(String $id , String $nombre,array $listas){
        $this->_id = $id;
        $this->nombre = $nombre;
        $this->listas=$listas;
    }
}
?>