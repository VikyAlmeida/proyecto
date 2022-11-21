<?php            
    $img = '';
    $titulo = '';
    foreach ($sectionsByEstablishment as $sectionFormat) {
        if ($sectionFormat['id_format'] == 1):
            $img = $sectionFormat['datum'];
        else:
            $titulo = $sectionFormat['datum'];
        endif;
    } 
?>  
<div class="roberto-contact-form-area ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Form -->
                <div class="roberto-contact-form">
                    <form action="" method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                <input type="text" name="name" class="form-control mb-30" placeholder="Titulo" value="<?= $titulo ?>">
                            </div>
                            <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                            </div>
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                <img src="<?= $img ?>" alt="">
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