<?php
    require_once("conexion.php");

    class UserModel {
        public static function where($tabla,$condicion){
            $conexion = Conectar::conectate();
            
            $sentencia = $conexion->prepare("SELECT * FROM $tabla where ".$condicion);
            $sentencia->execute();
            if($sentencia->rowCount()>1):
                return $sentencia->fetchAll();
            else:
                return $sentencia->fetch();
            endif;

            $sentencia = null;
        }
        
        public static function insert($tabla,$datos){
            $conexion = Conectar::conectate();
            
            $consulta = "Insert into $tabla (name,dni,email,password)values(?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["nombre"],$datos["dni"],$datos["email"],$datos["pass"])))
            {return true;}
            else
            {return false;}
        }
        
        public static function update($datos,$id){
            $conexion = Conectar::conectate();

            $tabla = "users";	
            $consulta = "UPDATE $tabla SET name = ?, dni = ?, email = ?, password = ? WHERE id like ?";
            $resultado = $conexion->prepare($consulta);
            if($resultado->execute(array($datos["nombre"],$datos["dni"],$datos["email"],$datos["pass"],$id)))
            {return true;}
            else{return false;}
        }
    }