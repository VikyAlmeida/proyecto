<?php
class PostController{
    public function getPosts($query){
        if ($query == null) $query = 'SELECT * FROM posts';
        
        $registros = PostModel::getPosts($query);
        return $registros;
    }
    public static function getPost($field, $value) {
        $registro = PostModel::getPost($field, $value);
        return $registro;
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = Generales::sanar_datos($_POST["title"],"string",$errores,"titulo");
            $text = Generales::sanar_datos($_POST["text"],"string",$errores,"texto");
            $id_establishment = (int)$_POST["id_establishment"];
            $show = isset($_POST["show"]) ? 1 : 0;
            $img =  './vistas/img/ayamonte/establisment/'.$id_establishment.'/posts/'.Generales::foto($_FILES["file"], './vistas/img/ayamonte/establisment/'.$id_establishment.'/posts/');
            if(empty($errores) && $errores !== ''){
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
            } else {
                echo "<script>
                        Swal.fire(
                        'Oops...!',
                        'Los datos introducidos son incorrectos, estos son los siguientes errores: <br> $errores',
                        'error'
                    ).then(() => window.location= 'menu');
                    </script>"; 
            }
        }
    }

    public function updated() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (!isset($_POST['ayuda']) or $_POST['ayuda'] != 'showPost'):
                $title = Generales::sanar_datos($_POST["title"],"string",$errores,"titulo");
                $text = Generales::sanar_datos($_POST["text"],"string",$errores,"texto");
                $id = $_POST['id'];
                $show = isset($_POST["show"]) ? 1 : 0;
                if($_FILES["file"]["size"]>0): 
                    $img =  './vistas/img/ayamonte/establisment/'.$_POST["id_establishment"].'/posts/'.Generales::foto($_FILES["file"], './vistas/img/ayamonte/establisment/'.$_POST["id_establishment"].'/posts/');
                else:
                    $img = $_POST['img'];
                endif;
            endif;

            if(!isset($errores) or (empty($errores) && $errores !== '')){
                if (isset($_POST['ayuda']) && $_POST['ayuda'] == 'showPost'):
                    if(PostModel::showAction($_POST['id'], $_POST['accion'])):
                        echo "<script>
                                Swal.fire(
                                'Actualizado!',
                                'Se ha actualizado la post con exito.',
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
                else:
                    $datos = compact('title', 'text', 'show', 'img');
                    if(PostModel::updated($datos, $id)):
                        echo "<script>
                                Swal.fire(
                                'Actualizado!',
                                'Se ha actualizado la post con exito.',
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