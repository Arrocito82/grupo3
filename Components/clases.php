<?php

use MongoDB\Client as db;

class Usuario{
    public $id;
    public $login,$listas=[],$listas_tmp=[];
    function __construct($id) {
        $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
        $client =  new db($uri);
        $collection =$client->grupo03->Usuario;
        $usuario = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));
        $this->listas_tmp=$usuario['listas'];
        
        $tmp=$usuario['_id'];
        settype($tmp,'string');
        $this->id= $tmp;        
        $this->login= $usuario['login'];
        


    }
    function get_login(){
        return $this->login;
    }
    
    function get_id(){
        return $this->id;
    } 
    function get_listas_tmp(){
        return $this->listas_tmp;
    }
    
    function get_listas(){
        for ($i=0; $i < count($this->get_listas_tmp()); $i++) { 
            
        
        $this->listas[$i]=new Lista($this->get_listas_tmp()[$i]);}
        return $this->listas;
    } 
    
    

}
class Categoria{
    public $id;
    public $nombre;
    function __construct($id) {
        $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
        $client =  new db($uri);
        $collection =$client->grupo03->Categoria;
        $categoria = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));
       
        $tmp=$categoria['_id'];
        settype($tmp,'string');
        $this->id= $tmp;        
        $this->nombre= $categoria['nombre'];
    }
    function get_nombre(){
        return $this->nombre;
    }
    
    function get_id(){
        return $this->id;
    }

}


class Autor{
    public $id;
    public $nombre;
    function __construct($id) {
        $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
        $client =  new db($uri);
        $collection =$client->grupo03->Autor;
       
        $autor = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));
        $tmp=$autor['_id'];
        settype($tmp,'string');
        $this->id= $tmp;        
        $this->nombre= $autor['nombre'];
    }
    function get_nombre(){
        return $this->nombre;
    }
    
    function get_id(){
        return $this->id;
    }

}


class Genero{
    public $id;
    public $nombre;
    function __construct($id) {
        $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
        $client =  new db($uri);
        $collection =$client->grupo03->Genero;
       
        $genero = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));//recuperando el genero
        $tmp=$genero['_id'];
        settype($tmp,'string');
        $this->id= $tmp;        
        $this->nombre= $genero['nombre'];
    }
    function get_nombre(){
        return $this->nombre;
    }
    
    function get_id(){
        return $this->id;
    }

}


class Audio {
    
    //declaracion de variables
    public $id;
    public $url;
    public $titulo;

    //estos son objetos
    public $usuario;
    public $generos=[];
    public $categorias=[];
    public $autores=[];
  
    function __construct($id) {
      $this->id = $id;
      $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
      $client =  new db($uri);
      $collection =$client->grupo03->Audio;
      $audio = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));//recuperando audio
      $this->titulo=$audio['titulo'];
      $this->url=$audio['url'];
      $this->usuario=new Usuario ($audio['id_usuario']);
      


    //   extrayendo ids de generos,categorias y autores...son arrays
      $genero_ids=$audio['id_genero'];
      $categoria_ids=$audio['id_categoria'];
      $autor_ids=$audio['id_autor'];
     

      //recuperando los generos,categorias y autores; se guardan como objetos
     for ($i=0; $i <count($genero_ids) ; $i++) { 
        $id=$genero_ids[$i];//este es el id del genero
        $this->generos[$i]=new Genero($id);
     }unset($i); 
     
     for ($i=0; $i <count($autor_ids) ; $i++) { 
        $id=$autor_ids[$i];//este es el id del genero
        $this->autores[$i]=new Autor($id);
     }unset($i); 
     
     for ($i=0; $i <count($categoria_ids) ; $i++) { 
        $id=$categoria_ids[$i];//este es el id del genero
        $this->categorias[$i]=new Categoria($id);
     }unset($i);
     

    }
    function get_document($filtro,$id){

    }
    function get_id() {
      return $this->id;
    }
    function get_url() {
      return $this->url;
    }
    function get_titulo() {
      return $this->titulo;
    }
    function get_usuario() {
        return $this->usuario;
    }
    function get_autores() {
      return $this->autores;
    }
    
    function get_categorias() {
      return $this->categorias;
    }
    function get_generos() {
      return $this->generos;
    }
    
  }
  class Lista {
    
    //declaracion de variables
    public $id;
    public $nombre;
    public $audios=[];
  
    function __construct($id) {
      $this->id = $id;
      $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
      $client =  new db($uri);
      $collection =$client->grupo03->Lista;
      //recuperar la lista con el id
      $lista = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));
      $this->nombre=$lista['nombre'];
      //recuperar la lista de audios de la lista
      $audio_ids=$lista['lista'];
            for ($i=0; $i <count($audio_ids) ; $i++) { 
                    $id=$audio_ids[$i];//este es el id del genero
                    $this->audios[$i]=new Audio($id);
            }
       unset($i);
        
    }
    function get_nombre(){
        return $this->nombre;
    }
    function get_audios(){
        return $this->audios;
    }
}
?>