<?php
class EstablishmentController{
    public function getEstablishments($query) {
        if ($query == null) $query = 'SELECT * FROM establishments';
        
        $registros = EstablishmentModel::getEstablishments($query);
        return $registros;
    }
    public function getImageFavorite($id) {
        $query = 'SELECT * FROM establisments_image where id_establishment like '.$id.' and favorite = true';
        
        $registro = EstablishmentModel::getEstablishmentImage($query);
        return $registro;
    }
}