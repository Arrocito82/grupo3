<?php
namespace Components;
class Alert{
    /**
     * Retorna un div que sirve como alert
     * 
     * $message: Mensaje en el alert
     * 
     * $clases: Clases del Alert. Ejemplo alert-primary, alert-success o cualesquera etc.
     * 
     */
    public static function SimpleAlert(String $message , String $clases){
        $format = '<div class="%s"> %s </div>';        
        return sprintf($format ,$clases ,$message);
    }
    
}
?>