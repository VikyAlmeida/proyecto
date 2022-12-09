<div class="breadcrumb-area bg-img bg-overlay jarallax" style="margin-top:1em;background-color:#718F94;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Panel de administracion</h2>
                        <h3 style='color:white;'>Formato</h3>
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
    $formatController = new FormatController();
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
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Nombre del formato">
                                </div>
                                <div class="col-12 col-lg-6 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                                </div>
                            </div>
                                <?php
                                    $formatController->create();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    elseif ($ruta[2] == 'edit'): 
        $format =$formatController->getFormat('id',$ruta[1]);
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
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Nombre de la categoria" value=<?=$format['name']?> />
                                </div>
                                <div class="col-12 col-lg-6 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Actualizar</button>
                                </div>
                            </div>
                                <?php
                                    $formatController->updated($ruta[1]);
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    else :
        $formatController->deleted($ruta[1]);
    endif; 
?>
