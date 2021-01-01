<?php
namespace Models;

    class Lista{
        public $_id , $nombre;
        public $audios = [];

        function __construct(String $_id , String $nombre , array $audios){
            $this->_id = $_id;
            $this->nombre = $nombre;
            $this->audios = $audios;
        }
    }
    
    class SimpleLista{
        public $_id , $nombre;


        function __construct(String $_id , String $nombre){
            $this->_id = $_id;
            $this->nombre = $nombre;
 
        }
    }