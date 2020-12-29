<?php
namespace Models;

    class Categoria{
        public  $nombre;
        public  $id;
        function __construct( String $nombre , String $id){
            $this->nombre = $nombre;
            $this->id = $id;
        }
    }
?>