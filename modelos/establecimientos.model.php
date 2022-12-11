<?php
    require_once("conexion.php");

    class EstablishmentModel {
        static $tabla = 'establisments';
        static $tabla_image = 'establisments_image';
        static $tabla_valoration = 'valoration';

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
        public static function addEstablishment($datos){
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;
            
            $query = "insert into ".$tabla." (name, location, slug, id_category) value (?,?,?,?);";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["name"], $datos["location"], $datos["slug"], $datos["id_category"])))
            {return true;}
            else
            {return false;}
        }
        public static function updated($datos,$id){
            $conexion = Conectar::conectate();
            $tabla = self::$tabla;

            $consulta = "UPDATE $tabla SET name = ?, description = ?, id_category = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["name"],$datos["description"],$datos["category_id"],$id)))
            {return true;}
            else{return false;}
        }
        public static function valorate($datos){
            $conexion = Conectar::conectate();
            $tabla = self::$tabla_valoration;

            $result = $conexion->query('SELECT * FROM valoration where id_user = '.$_SESSION["usuario"]["id"].' and id_establishment = '.$datos["idEstablishment"]);
            
            if($result->rowCount()==1):
                // eliminar la mas antigua
                $result = $conexion->query('DELETE FROM valoration where id_user = '.$_SESSION["usuario"]["id"].' and id_establishment = '.$datos["idEstablishment"]);
            endif;

            $query = "insert into ".$tabla." (id_user, id_establishment, valorate) value (?,?,?);";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["idUser"], $datos["idEstablishment"], $datos["value"])))
            {return true;}
            else
            {return false;}
        }
        public static function addPhoto($datos){
            $conexion = Conectar::conectate();
            $tabla = self::$tabla_image;
            var_dump($datos);
            
            $query = "insert into ".$tabla." (img, id_establishment) value (?,?);";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["image"], $datos["id"])))
            {return true;}
            else
            {return false;}
        }
        public static function getValorate($query) {           
            $conexion = Conectar::conectate();

            $result = $conexion->query($query);
            if($result->rowCount()>1):
                return $result->fetchAll();
            else:
                return $result->fetch();
            endif;
        }
    }