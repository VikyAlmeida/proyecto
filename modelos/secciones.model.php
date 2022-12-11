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

        public static function addData($datum) {
            $conexion = Conectar::conectate();
            
            $query = "Insert into datas (datum) values (?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datum)))
            {
                $result = $conexion->query('SELECT id FROM datas order by id desc limit 1');
                return $result->fetch();
            }
            else
            {return false;}
        }

        public static function deletedConfiguracion($establishment, $section) {
            $conexion = Conectar::conectate();
            $query = 'SELECT * FROM styles where id_establishment = '. $establishment .' and id_section = '.$section;
            $result = $conexion->query($query);
            $styles = $result->fetchAll();

            $query = "DELETE FROM styles where id_establishment = $establishment and id_section = $section";
            $result = $conexion->exec($query);

            foreach ($styles as $style) {
                $id_data = (int)$style['id_data'];
                $query = "DELETE FROM datas where id = ".$id_data;
                $result = $conexion->exec($query);
            }
        }


        public static function addStyles($datos) {
            $conexion = Conectar::conectate();
            
            $query = "Insert into styles (id_format, id_establishment, id_section, id_data) values (?, ?, ?, ?)";
            $result = $conexion->prepare($query);
            if($result->execute(array($datos["format"], $datos["establishment"], $datos["section"], $datos["data"])))
            {return true;}
            else
            {return false;}
        }
    }