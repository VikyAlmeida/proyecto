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
            $slug = $_POST["slug"];
            $category_id = $_POST["category_id"];
            if(empty($errores)){
                $datos = compact('name', 'slug', 'category_id', 'category_id');
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
            }
        }
    }
    public function favoriteImage($idImg){
        $ruta = $_GET['ruta'];
        $query = 'SELECT * FROM establisments_image where id = '.$idImg.'';
        $img = EstablishmentModel::getEstablishmentImage($query);

        if ($img['favorite']):
            echo "<script>
                   Swal.fire(
                     'error',
                     'Oops...!',
                     'Operación inválida. Tiene que haber minimo una imagen favorita',  
                     ).then(() => window.location= '$ruta');
           </script>";
        else:
            $query = 'UPDATE $establisments_image SET favorite = 1 WHERE id like '.$idImg;
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
        }
    }
}