<?php
    require_once("conexion.php");

    class SocialNetworkModel {
        public static function getSocialNetworks($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function showSocialNetwork($tabla, $field, $value){            
            $conexion = Conectar::conectate();

            $query = "SELECT * FROM $tabla where $field like '$value'";
            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }

        public static function addSocialNetwork($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $query = "Insert into $tabla (name, logo) values (?, ?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"], $datos["image"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function updateSocialNetwork($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "social_networks";	
            $consulta = "UPDATE $tabla SET name = ?, logo = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"], $datos["image"], $id)))
            {return true;}
            else{return false;}
        }

        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = "social_networks";
            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }

    }