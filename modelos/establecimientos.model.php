<?php
    require_once("conexion.php");

    class EstablishmentModel {
        public static function getEstablishments($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }
        public static function getEstablishmentImage($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }
    }