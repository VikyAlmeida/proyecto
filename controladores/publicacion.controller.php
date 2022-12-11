<?php
class PostController{
    public function getPosts($query){
        if ($query == null) $query = 'SELECT * FROM posts';
        
        $registros = PostModel::getPosts($query);
        return $registros;
    }
    public static function getPost($field, $value) {
        $registro = PostModel::getPost("posts",$field, $value);
        return $registro;
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = Generales::sanar_datos($_POST["title"],"string",$errores,"nombre");
            $text = Generales::sanar_datos($_POST["text"],"string",$errores,"nombre");
            $id_establishment = Generales::sanar_datos($_POST["id_establishment"],"string",$errores,"nombre");
            $show = Generales::sanar_datos($_POST["show"],"string",$errores,"nombre");
            $img =  './vistas/img/establishment/'.$id_establishment.'/posts/'.Generales::foto($_FILES["file"], './vistas/img/Posts/');
            if(empty($errores)){
                $datos = compact('title', 'text', 'id_establishment', 'show', 'img');
                if(PostModel::add($datos)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha Añadido la red social con exito.',
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
            $title = Generales::sanar_datos($_POST["title"],"string",$errores,"titulo");
            $text = Generales::sanar_datos($_POST["text"],"string",$errores,"nombre");
            $id_establishment = Generales::sanar_datos($_POST["id_establishment"],"string",$errores,"nombre");
            $show = Generales::sanar_datos($_POST["show"],"string",$errores,"nombre");
            $img =  './vistas/img/establishment/'.$id_establishment.'/posts/'.Generales::foto($_FILES["file"], './vistas/img/Posts/');
            
            if(empty($errores)){
                $datos = compact('title', 'text', 'id_establishment', 'show', 'img');
                if(PostModel::updated($datos,$id)):
                    echo "<script>
                            Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado la red social con exito.',
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
        if(PostModel::delete($id)):
            echo "<script>
                    Swal.fire(
                    'Eliminado!',
                    'Se ha eliminado la red social con exito.',
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