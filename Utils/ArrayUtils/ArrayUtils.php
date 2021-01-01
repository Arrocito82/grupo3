<?php
 namespace Utils\ArrayUtils;

 class ArrayUtils{
      /**
     * Retorna la suma de las propiedades de un Array de Objetos, especificando el array y la propiedad a sumar
     */
    private static function ObjectLinearString($array , $key){
        $result = "";
        foreach ($array as $element) {
            # code...
           $result .= " {$element->{$key}}," ; 
        }
        
        return $result;
    }
 }
?>