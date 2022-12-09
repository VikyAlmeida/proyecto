<?php
    require_once("conexion.php");

    class CategoryModel {
        public static function getCategories($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function showCategory($tabla, $field, $value){            
            $conexion = Conectar::conectate();

            $query = "SELECT * FROM $tabla where $field like '$value'";
            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();

            $result = null;
        }

        public static function addCategory($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $query = "Insert into $tabla (name, img) values (?, ?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"], $datos["image"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function updateCategory($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "categories";	
            $consulta = "UPDATE $tabla SET name = ?, img = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["image"],$id)))
            {return true;}
            else{return false;}
        }
        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = "categories";
            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }

    }