<?php
    $establishmentController = new establishmentController();
    $establishments = $establishmentController->getEstablishments('SELECT * FROM establisments where id_owner = '.$_SESSION["usuario"]["id"]);
    //graficos
    $visitsClientOrNot = $establishmentController->getGraphicsData('SELECT if(count(date_of_booking)>0, 1, 0) as client
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by v.id_user');
                                                                    
    $visitsByMonth = $establishmentController->getGraphicsData('SELECT month(v.created_at) as mes, count(id_user) as visit
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by month(created_at)');

    $establishmentMoreVisited = $establishmentController->getGraphicsData('SELECT e.name, count(v.id) as visits
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by e.id');

    $categoriesEstablishment = $establishmentController->getGraphicsData('SELECT id_category, c.name as name, count(e.id) as establishmentByCategory 
                                                                    FROM establisments e join categories c on c.id=id_category 
                                                                    group by id_category;');
    $visitsClientOrNot_json = json_encode($visitsClientOrNot);
    $visitsByMonth_json = json_encode($visitsByMonth);
    $establishmentMoreVisited_json = json_encode($establishmentMoreVisited);
    $categories_json = json_encode($categoriesEstablishment);
?> 
<div style='margin:1em;display:flex;'>
    <?php if ($establishments): ?>
        <div class="col-12 col-lg-12" style='margin:0.1em;'>
            <section class="roberto-about-area" 
                        style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:100%; 
                        border-color:rgba(255, 99, 132, 1)"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><a class="btn btn-primary" href="categorias-new">Añadir establecimiento</a></h6>
                                <h2>Mis establecimientos</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableCategories'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Name</th>
                                            <th colspan="3" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($establishments as $establishment):
                                            $img = $establishmentController->getImageFavorite($establishment['id']);                                        
                                        ?>
                                            <tr>
                                                <td><img src="<?=$img['img']?>" alt="categoria<?=$establishment['id']?>" width='250' style='height:200px'></td>
                                                <td><?=$establishment['name']?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='miLocal-<?=$establishment['slug']?>-configuration' type="button" class="btn btn-outline-secondary">
                                                        Configurar
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='miLocal-<?=$establishment['slug']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-12" style='margin:1em'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(255, 99, 132, 1)"
                >
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                    <h6><button class="btn btn-primary" href="category">Añadir establecimiento</button></h6>
                                    <h2>Mis establecimientos</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay establecimientos</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
    
</div>