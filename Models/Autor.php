<?php
namespace Models;

    class Autor{
        public  $nombre;
        public  $id;
        function __construct( String $nombre , String $id){
            $this->nombre = $nombre;
            $this->id = $id;
        }
    }
?>