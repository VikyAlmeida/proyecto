<?php
class EstablishmentController{
    public function getEstablishments($query) {
        if ($query == null) $query = 'SELECT * FROM establishments';
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
}