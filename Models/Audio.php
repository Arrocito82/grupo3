<?php
namespace Models;

class Audio{
    public $_id , $url , $titulo , $usuario;
    public $Autores = array();
    public $Categorias = array();
    public $Generos = array();

    function __construct($_id, $url , $titulo , $usuario , $Autores ,  $Categorias , $Generos){
        $this->_id =$_id;
        $this->url =$url;
        $this->titulo =$titulo;
        $this->usuario =$usuario;
        $this->Autores =$Autores;
        $this->Categorias =$Categorias;
        $this->Generos =$Generos;
    }

    
    
}
?>