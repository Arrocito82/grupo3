<?php
namespace Models;

    
    
    class SimpleLista{
        public $_id , $nombre;


        function __construct(String $_id , String $nombre){
            $this->_id = $_id;
            $this->nombre = $nombre;
 
        }
    }