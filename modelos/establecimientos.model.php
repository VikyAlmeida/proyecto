<?php
    require_once("conexion.php");

    class EstablishmentModel {
        static $tabla = 'establisments';
        static $tabla_image = 'establisments_image';
        public static function getEstablishments($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetch();
            endif;
        }
        public static function getGraphics($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            return $result->fetchAll();
        }
        public static function getEstablishmentImageFavorite($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetch();
        }
        
        public static function getEstablishmentImage($query){            
            $conexion = Conectar::conectate();

            $result = $conexion->prepare($query);
            $result->execute();
            return $result->fetchAll();
        }
        public static function eliminar_fotos($id){
            $conexion = Conectar::conectate();

            $tabla = self::$tabla_image;
            
            $consulta = "SELECT * FROM $tabla where id_establishment = $id";
            $resultado = $conexion->query($consulta);
            $datos = $resultado->fetchAll();
            foreach($datos as $dato)
            {
                if($dato["img"] != "default.jpg"):
                    unlink($dato["img"]);
                    $conexion->exec("DELETE FROM $tabla where id like '".$dato['id']."'");
                endif;
            }
        }
        public static function delete($id) {
            $conexion = Conectar::conectate();

            $tabla = self::$tabla;
            
            self::eliminar_fotos($id);

            $query = "DELETE FROM $tabla where id like '$id'";
            if($conexion->exec($query))
            {return true;}
            else{return false;}
        }
    }