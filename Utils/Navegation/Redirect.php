<?php 
    namespace Utils\Navegation;

    class Redirect{
        /**
         * Redirecciona al instante usando Javascript
         * 
         * $URL: URL destino
         */
        public static function RedirectInstant($URL){
            echo '<script type="text/javascript">
                    window.location.replace("'.$URL.'");
                </script>';
        }
        /**
         * Redirecciona a la url especificada en el tiempo especificado usando Javascript
         * 
         * $URL: URL destino
         * 
         * $seconds: Tiempo en secundos
         */
        public static function RedirectWithTimer($URL , $seconds){
            echo '<script type="text/javascript">
                    setTimeout(function(){ 
                        window.location.replace("'.$URL.'"); 
                    }, '.($seconds*1000).');                    
                </script>';
        }
    }
?>


