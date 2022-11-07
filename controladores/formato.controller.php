<?php
class FormatController{
    public function getFormats($query){
        if ($query == null) $query = 'SELECT * FROM formats';
        
        $registros = FormatModel::getFormats($query);
        return $registros;
    }

    public function getFormat($field, $value) {        
        $registros = FormatModel::getFormat("formats",$field, $value);
        return $registros;
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            if(empty($errores)){
                $datos = compact('name');
                if(FormatModel::add("formats",$datos)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha Añadido el formato con exito.',
                            'success'
                        ).then(() => window.location= 'menu');
                        </script>"; 
                else:
                    echo "<script>
                           Swal.fire(
                             'error',
                             'Oops...!',
                             'Operación inválida.',  
                             ).then(() => window.location= 'menu');
                   </script>";
                endif;
            }
        }
    }

    public function updated($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            
            if(empty($errores)){
                $datos = compact('name');
                if(FormatModel::update($datos,$id)):
                    echo "<script>
                            Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado el formato con exito.',
                            'success'
                        ).then(() => window.location= 'menu');
                        </script>"; 
                else:
                    echo "<script>
                           Swal.fire(
                             'error',
                             'Oops...!',
                             'Operación inválida.',  
                             ).then(() => window.location= 'menu');
                   </script>";
                endif;
            }
        }
    }

    public static function deleted($id){
        $id = (int)$id;
        if(FormatModel::delete($id)):
            echo "<script>
                    Swal.fire(
                    'Eliminado!',
                    'Se ha eliminado el formato con exito.',
                    'success'
                ).then(() => window.location= 'menu');
                </script>"; 
        else:
            echo "<script>
                   Swal.fire(
                     'error',
                     'Oops...!',
                     'Operación inválida.',  
                     ).then(() => window.location= 'menu');
           </script>";
        endif;
    }
}