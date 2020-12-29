<?php
namespace Models;
class Usuario{
    public $_id , $nombre;

    function __construct(String $id , String $nombre){
        $this->_id = $id;
        $this->nombre = $nombre;
    }
}
?>