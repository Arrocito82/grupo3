<?php
 namespace Utils\ArrayUtils;

 class ArrayUtils{
      /**
     * Retorna la suma de las propiedades de un Array de Objetos, especificando el array y la propiedad a sumar
     */
    public static function ObjectLinearString($array , $key){
        $result = "";
        for ($i=0 ; $i<count($array) ; $i++) {
            # code...
            $element = $array[$i];
            $result .= " {$element->{$key}}";
            if($i<count($array)-1)
                $result .= ", "; 
        }
        
        return $result;
    }
    
 }
?>