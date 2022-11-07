<?php
    require_once("conexion.php");

    class FormatModel {
        public static function getFormats($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function getFormat($tabla, $field, $value){            
            $conexion = Conectar::conectate();

            $query = "SELECT * FROM $tabla where $field like '$value'";
            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }

        public static function add($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $query = "Insert into $tabla (name) values (?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function update($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "formats";	
            $consulta = "UPDATE $tabla SET name = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"], $id)))
            {return true;}
            else{return false;}
        }

        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = "formats";
            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }

    }