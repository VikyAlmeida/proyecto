<?php
    require_once("conexion.php");

    class PostModel {
        static $tabla = 'posts';

        public static function getPosts($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();

            $result = null;
        }

        public static function getPost($field, $value){            
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
            
            $query = "INSERT INTO posts (title, text, id_establishment, showPost, img) values (?,?,?,?,?);";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["title"], $datos["text"], $datos["id_establishment"], $datos["show"], $datos["img"])))
            {return true;}
            else
            {return false;}
        }

        public static function updated($datos, $id) {
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;
            
            $query = "UPDATE $tabla SET title = ?, text = ?, img = ?, showPost = ? WHERE id = ?";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["title"], $datos["text"], $datos["img"], $datos["show"], $id)))
            {return true;}
            else
            {return false;}
        }

        public static function showAction($id, $show) {
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;
            echo $id . ''. $show;
            $query = "UPDATE $tabla SET showPost = ? WHERE id = ?";
            $result = $conexion->prepare($query);
            if($result->execute(array($show, $id)))
            {return true;}
            else
            {return false;}
        }

        public static function eliminar_foto($id){
            $conexion = Conectar::conectate();

            $tabla = self::$tabla;
            
            $consulta = "SELECT * FROM $tabla where id = $id";
            $resultado = $conexion->query($consulta);
            $dato = $resultado->fetch();
            unlink($dato["img"]);
        }
        
        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = self::$tabla;
            
            self::eliminar_foto($id);

            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }
    }