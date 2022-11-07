<div class="breadcrumb-area bg-img bg-overlay jarallax" style="margin-top:1em;background-color:#718F94;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Panel de administracion</h2>
                        <h3 style='color:white;'>Secciones</h3>
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
<?php
    $sectionController = new SectionController();
    $ruta = explode("-", $_GET["ruta"]);
    if ($ruta[1] == "new") :
?>
    <div class="roberto-contact-form-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Nombre de la seccion">
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                                </div>
                            </div>
                                <?php
                                    $sectionController->create();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    elseif ($ruta[2] == 'edit'): 
        $socialNetwork =$sectionController->getSection('id',$ruta[1]);
?>
    <div class="roberto-contact-form-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms" style="text-align: right">
                                    <img src="<?=$socialNetwork['file']?>" alt="">
                                </div>
                                <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Nombre de la categoria" value=<?=$socialNetwork['name']?> />
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                                    <input type="hidden" name="file" class="form-control mb-30" value=<?=$socialNetwork['file']?>>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Actualizar</button>
                                </div>
                            </div>
                                <?php
                                    $sectionController->updated($ruta[1]);
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    else :
        $sectionController->deleted($ruta[1]);
    endif; 
?>

