<?php
namespace Models;

    class Categoria{
        public String $nombre;
        public String $id;
        function __construct( String $nombre , String $id){
            $this->nombre = $nombre;
            $this->id = $id;
        }
    }
?>