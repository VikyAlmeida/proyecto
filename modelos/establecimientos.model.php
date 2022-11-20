<?php
    require_once("conexion.php");

    class EstablishmentModel {
        public static function getEstablishments($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetchAll();
            endif;
        }
        public static function getEstablishmentImage($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();
        }
    }