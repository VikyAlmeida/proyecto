<?php
class SocialNetworkController{
    public function getSocialNetworks($query){
        if ($query == null) $query = 'SELECT * FROM social_networks';
        
        $registros = SocialNetworkModel::getSocialNetworks($query);
        return $registros;
    }
    public static function getSocialNetwork($field, $value) {
        $registro = SocialNetworkModel::showSocialNetwork("social_networks",$field, $value);
        return $registro;
    }
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            $image =  './vistas/img/socialNetworks/'.Generales::foto($_FILES["file"], './vistas/img/socialNetworks/');
            if(empty($errores)){
                $datos = compact('name', 'image');
                if(SocialNetworkModel::addSocialNetwork("social_networks",$datos)):
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
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            if ($_FILES['file']['size'] == 0): 
                $image = $_POST['image'];
            else: 
                $image =  './vistas/img/socialNetworks/'.Generales::foto($_FILES["file"], './vistas/img/socialNetworks/');
            endif;
            
            if(empty($errores)){
                $datos = compact('name', 'image');
                if(SocialNetworkModel::updateSocialNetwork($datos,$id)):
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
        if(SocialNetworkModel::delete($id)):
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