<?php
    require_once("conexion.php");

    class MessengerModel {
        static $tabla = 'messenger_service';

        public static function getMessages($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function getMessage($field, $value){            
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;

            $query = "SELECT * FROM $tabla where $field like '$value'";
            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }

        public static function add($datos) {
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;
            
            $query = "Insert into $tabla (name) values (?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"])))
            {return true;}
            else
            {return false;}
        }
    }