<?php
namespace Models;

class Audio{
    public $_id , $url , $titulo , $usuario;
    public $Autores = array();
    public $Categorias = array();
    public $Generos = array();

    function __construct($_id, $url , $titulo , $usuario , $id_autor ,  $Categorias , $Generos){
        $this->_id =$_id;
        $this->url =$url;
        $this->titulo =$titulo;
        $this->usuario =$usuario;
        $this->Autores =$id_autor;
        $this->Categorias =$Categorias;
        $this->Generos =$Generos;
    }

    
    
}
?>