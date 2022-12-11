<?php
class EstablishmentController{
    public function getEstablishments($query) {
        if ($query == null) $query = 'SELECT * FROM establisments';
        $registros = EstablishmentModel::getEstablishments($query);
        return $registros;
    }
    public function getGraphicsData($query) {
        if ($query == null) $query = 'SELECT * FROM establishments';
        $registros = EstablishmentModel::getGraphics($query);
        return $registros;
    }
    public function getImageFavorite($id) {
        $query = 'SELECT * FROM establisments_image where id_establishment like '.$id.' and favorite = true';
        
        $registro = EstablishmentModel::getEstablishmentImageFavorite($query);
        return $registro;
    }
    public function getImage($id) {
        $query = 'SELECT * FROM establisments_image where id_establishment = '.$id.'';
        
        $registro = EstablishmentModel::getEstablishmentImage($query);
        return $registro;
    }
    public function delete($id) {
        $id = (int)$id;
        if(EstablishmentModel::delete($id)):
            echo "<script>
                    Swal.fire(
                    'Eliminado!',
                    'Se ha eliminado el establecimiento con exito.',
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
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            $location = $_POST["location"];
            $slug = str_replace(" ", "-", $name);
            $id_category = $_POST["category"];
            if(empty($errores)){
                $datos = compact('name', 'slug', 'location', 'id_category');
                if(EstablishmentModel::addEstablishment($datos)):
                    echo "<script>
                            Swal.fire(
                            'Añadido!',
                            'Se ha Añadido el establecimiento con exito.',
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
                         'error',
                         'Oops...!',
                         'Los datos son incorrectos',  
                         ).then(() => window.location= 'menu');
               </script>";

            }
        }
    }
    public function favoriteImage($idImg){
        $query = 'SELECT * FROM establisments_image where id = '.$idImg.'';
        $img = EstablishmentModel::getEstablishmentImage($query);

        if ($img[0]['favorite']):
            echo "<script>
                   Swal.fire(
                     'error',
                     'Oops...!',
                     'Operación inválida. Tiene que haber minimo una imagen favorita',  
                     ).then(() => window.location= 'menu');
           </script>";
        else:
            $query = 'UPDATE establisments_image SET favorite = 0 where id_establishment = '.$img['id_establishment'];
            EstablishmentModel::getEstablishmentImage($query);
            $query = 'UPDATE establisments_image SET favorite = 1 WHERE id like '.$idImg;
            EstablishmentModel::getEstablishmentImage($query);
        endif;
    }
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ruta = $_GET['ruta'];
            $name = Generales::sanar_datos($_POST["name"],"string",$errores,"nombre");
            $category_id = Generales::sanar_datos($_POST["category"],"int",$errores,"categoria");
            $description = Generales::sanar_datos($_POST["description"],"string",$errores,"descripción");
            if(empty($errores)){
                $datos = compact('name', 'category_id', 'description');
                if(EstablishmentModel::updated($datos, $id)):
                    echo "<script>
                            Swal.fire(
                            'Actualizado!',
                            'Se ha actualizado el local con exito.',
                            'success'
                        ).then(() => window.location= '$ruta');
                        </script>"; 
                else:
                    echo "<script>
                           Swal.fire(
                             'error',
                             'Oops...!',
                             'Operación inválida.',  
                             ).then(() => window.location= '$ruta');
                   </script>";
                endif;
            }
        }
    }
    public function valoration($value, $idEstablishment){
        $idUser = $_SESSION["usuario"]["id"];
        if(empty($errores)){
            $datos = compact('value', 'idEstablishment', 'idUser');
            if(EstablishmentModel::valorate($datos)):
                echo "<script>
                        Swal.fire(
                        'Añadido!',
                        'Se ha Añadido el establecimiento con exito.',
                        'success'
                    ).then(() => window.location= 'establecimientos');
                    </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'error',
                            'Oops...!',
                            'Operación inválida.',  
                            ).then(() => window.location= 'establecimientos');
                </script>";
            endif;
        }
    }
    public function addPhoto($id, $file){
        if($file["size"]>=0){
            return "<script>
                    Swal.fire(
                        'error',
                        'Oops...!',
                        'Operación inválida.',  
                        ).then(() => window.location= 'menu');
            </script>";
        }
        $image =  './vistas/img/ayamonte/establisment/'.$_POST["id"].'/'.Generales::foto($file, './vistas/img/ayamonte/establisment/'.$_POST["id"].'/');
        if(empty($errores)){
            $datos = compact('id', 'image');
            if(EstablishmentModel::addPhoto($datos)):
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
                            ).then(() => window.location= 'configuration');
                </script>";
            endif;
        }
    }
    public function getValorate($query){
        if ($query == null) $query = 'SELECT * FROM valoration';
        $registros = EstablishmentModel::getValorate($query);
        return $registros;
    }
}