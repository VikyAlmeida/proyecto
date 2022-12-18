<?php
    for ($i=0;$i<100;$i++) {
        $name = 'Establecimiento-'.$i;
        $description = 'Description-'.$i;
        $location = 'C.C. La Plaza, Av. de la Constitución, '.$i.' 21400 Ayamonte, Huelva';
        $slug = str_replace(" ", "-", $name);
        $id_category = rand(1, 4);
        $datos = compact('name', 'slug', 'location', 'id_category');
        EstablishmentModel::addEstablishment($datos);
        $lastId = $establishmentController->getEstablishments('SELECT id FROM establisments order by id desc limit 1');
        $id = $lastId['id'];
        $image =  'https://picsum.photos/id/'.rand(1, 1000).'/300/200';
        $favorite = true;
        $datos = compact('id', 'image', 'favorite');
        EstablishmentModel::addPhotoFavorite($datos);
    }
    $_SESSION['data']=true;
