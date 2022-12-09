<?php
class SectionController{
    public function getSections($query){
        if ($query == null) $query = 'SELECT * FROM sections';
        
        $registros = SectionModel::getSections($query);
        return $registros;
    }

    public static function getSection($field, $value) {
        $registro = SectionModel::showSection("sections",$field, $value);
        return $registro;
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            $file =  './vistas/modulos/sections/'.Generales::file($_FILES["file"], './vistas/modulos/sections/');
            if(empty($errores)){
                $datos = compact('name', 'file');
                if(SectionModel::addSection("sections",$datos)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha Añadido la seccion con exito.',
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
    public function updated($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            if ($_FILES['file']['size'] == 0): 
                $file = $_POST['file'];
            else: 
                $file =  './vistas/modulos/sections/'.Generales::file($_FILES["file"], './vistas/modulos/sections/');
            endif;
            
            if(empty($errores)){
                $datos = compact('name', 'file');
                if(SectionModel::updateSection($datos,$id)):
                    echo "<script>
                            Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado la seccion con exito.',
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
    public static function deleted($id) {
        $id = (int)$id;
        if(SectionModel::delete($id)):
            echo "<script>
                    Swal.fire(
                    'Eliminado!',
                    'Se ha eliminado la seccion con exito.',
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