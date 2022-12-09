<?php
    require_once("conexion.php");

    class SectionModel {
        public static function getSections($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function showSection($tabla, $field, $value){            
            $conexion = Conectar::conectate();

            $query = "SELECT * FROM $tabla where $field like '$value'";
            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }

        public static function addSection($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $query = "Insert into $tabla (name, file) values (?, ?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"], $datos["file"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function updateSection($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "sections";	
            $consulta = "UPDATE $tabla SET name = ?, file = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["file"],$id)))
            {return true;}
            else{return false;}
        }
        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = "sections";
            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }
    }