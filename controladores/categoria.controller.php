<?php
class CategoryController{
    public function getCategories($query) {
        if ($query == null) $query = 'SELECT * FROM categories';
        
        $registros = CategoryModel::getCategories($query);
        return $registros;
    }
    public static function getCategory($field, $value) {
        $registro = CategoryModel::showCategory("categories",$field, $value);
        return $registro;
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            $image =  './vistas/img/categories/'.Generales::foto($_FILES["file"], './vistas/img/categories/');
            if(empty($errores)){
                $datos = compact('name', 'image');
                if(CategoryModel::addCategory("categories",$datos)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha Añadido la categoria con exito.',
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
                $image = $_POST['image'];
            else: 
                $image =  'views/images/categories/'.Generales::foto($_FILES["file"], 'views/images/categories/');
            endif;
            
            if(empty($errores)){
                $datos = compact('name', 'image');
                if(CategoryModel::updateCategory($datos,$id)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha actualizado la categoria con exito.',
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
        if(CategoryModel::delete($id)):
            echo "<script>
                    Swal.fire(
                    'Añadido!',
                    'Se ha eliminado la categoria con exito.',
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