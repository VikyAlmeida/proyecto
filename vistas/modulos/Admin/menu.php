<?php
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories(null);

    $formatController = new FormatController();
    $formats = $formatController->getFormats(null);

    $socialNetworkController = new SocialNetworkController();
    $socialNetworks = $socialNetworkController->getSocialNetworks(null);

    $sectionController = new SectionController();
    $sections = $sectionController->getSections(null);
?> 

<div class="breadcrumb-area bg-img bg-overlay jarallax" style="margin-top:1em;background-color:#718F94;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Panel de administracion</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item">Bienvenid@ <?= $_SESSION['usuario']['name'] ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($categories): ?>
    <div class="col-12 col-lg-6" style='margin:1em'>
        <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                            <h6><a class="btn btn-primary" href="categorias-new">Add categoria</a></h6>
                            <h2>Categories</h2>
                        </div>
                        <div class="col-12" style="margin-top:-5em">
                            <table class="table" id='tableCategories'>
                                <thead class="table-dark">
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Name</th>
                                        <th colspan="2" style='text-align:center;'>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><img src="<?=$category['img']?>" alt="categoria <?=$category['id']?>"></td>
                                            <td><?=$category['name']?></td>
                                            <td style='text-align:right;width:15%;'>
                                                <a href='categorias-<?=$category['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                    Editar
                                                </a>
                                            </td>
                                            <td style='text-align:left;width:15%'>
                                                <a href='categorias-<?=$category['id']?>-deleted' type="button" class="btn btn-outline-secondary">
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
    <div class="col-12 col-lg-6" style='margin:1em'>
            <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><button class="btn btn-primary" href="category">Add categoria</button></h6>
                                <h2>Categorias</h2>
                            </div>
                            <div class="col-12">
                                <h3>No hay categorias</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php endif; ?>

<?php if ($socialNetworks): ?>
    <div class="col-12 col-lg-6" style='margin:1em'>
        <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                            <h6><a class="btn btn-primary" href="redesSociales-new">Add Red social</a></h6>
                            <h2>Redes sociales</h2>
                        </div>
                        <div class="col-12" style="margin-top:-5em">
                            <table class="table" id='tableSocialNetwork'>
                                <thead class="table-dark">
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th colspan="2" style='text-align:center;'>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($socialNetworks as $socialNetwork): ?>
                                        <tr>
                                            <td><img src="<?=$socialNetwork['logo']?>" alt="red social <?=$socialNetwork['id']?>" width='100'></td>
                                            <td><?=$socialNetwork['name']?></td>
                                            <td style='text-align:right;width:15%;'>
                                                <a href='redesSociales-<?=$socialNetwork['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                    Editar
                                                </a>
                                            </td>
                                            <td style='text-align:left;width:15%'>
                                                <a href='redesSociales-<?=$socialNetwork['id']?>-deleted' type="button" class="btn btn-outline-secondary">
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
    <div class="col-12 col-lg-6" style='margin:1em'>
            <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><button class="btn btn-primary" href="newSocialNetwork">Add red social</button></h6>
                                <h2>Redes sociales</h2>
                            </div>
                            <div class="col-12">
                                <h3>No hay redes sociales</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php endif; ?>

<?php if ($formats): ?>
    <div class="col-12 col-lg-6" style='margin:1em'>
        <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                            <h6><a class="btn btn-primary" href="formato-new">Add formato</a></h6>
                            <h2>Formatos</h2>
                        </div>
                        <div class="col-12" style="margin-top:-5em">
                            <table class="table" id='tableFormat'>
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th colspan="2" style='text-align:center;'>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($formats as $format): $nombre = $format['name'];?>
                                        <tr>
                                            <td><?=$format['id']?></td>
                                            <td><?=$format['name']?></td>
                                            <td style='text-align:right;width:15%;'>
                                                <a href='formato-<?=$socialNetwork['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                    Editar
                                                </a>
                                            </td>
                                            <td style='text-align:left;width:15%'>
                                                <a href='formato-<?=$socialNetwork['id']?>-deleted' type="button" class="btn btn-outline-secondary">
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
    <div class="col-12 col-lg-6" style='margin:1em'>
            <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><button class="btn btn-primary" href="newSocialNetwork">Add Red social</button></h6>
                                <h2>Formatos</h2>
                            </div>
                            <div class="col-12">
                                <h3>No hay formatos</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php endif; ?>

<?php if ($sections): ?>
    <div class="col-12 col-lg-6" style='margin:1em'>
        <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                            <h6><a class="btn btn-primary" href="secciones-new">Add Seccion</a></h6>
                            <h2>Secciones</h2>
                        </div>
                        <div class="col-12" style="margin-top:-5em">
                            <table class="table" id='tableSection'>
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                        <th colspan="2" style='text-align:center;'>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sections as $section): ?>
                                        <tr>
                                            <td><?=$section['id']?></td>
                                            <td><?=$section['name']?></td>
                                            <td><?=$section['file']?></td>
                                            <td style='text-align:right;width:15%;'>
                                                <a href='secciones-<?=$section['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                    Editar
                                                </a>
                                            </td>
                                            <td style='text-align:left;width:15%'>
                                                <a href='secciones-<?=$section['id']?>-deleted' type="button" class="btn btn-outline-secondary">
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
    <div class="col-12 col-lg-6" style='margin:1em'>
            <section class="roberto-about-area" style="border: 1px solid black;padding:1em; border-radius: 3em">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><button class="btn btn-primary" href="newSection">Add section</button></h6>
                                <h2>Secciones</h2>
                            </div>
                            <div class="col-12">
                                <h3>No hay secciones</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php endif; ?>

