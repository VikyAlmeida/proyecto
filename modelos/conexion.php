<?php
class Conectar
{
    public static function conectate()
    {
        try
        {
            $bd = "inaya";
            $conexion = new PDO("mysql:host=localhost;dbname=$bd","root","");
            $conexion->exec("set names utf8");
            return $conexion;
        }
        catch(PDOexception $e){echo $e->getMessage();}
    }
}
