<?php
namespace Utils; 

interface IAuthentication{
    public static function autentificar(String $userName ,String $password);
}
?>