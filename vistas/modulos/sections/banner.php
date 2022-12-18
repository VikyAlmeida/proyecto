<?php
    $sectionController = new SectionController();
    $values = $sectionController->getConfig($miLocal['id'], $section['name']);
?>
<div class="col-12">
    <div class="roberto-contact-form">
        <form action="ayuda" method="post" enctype="multipart/form-data" >
            <div class="row" style="padding:2em;">
                <input type="hidden" name="local" value="<?= $miLocal['id'] ?>">
                <input type="hidden" name="section" value="<?= $section['id'] ?>">
                <input type="hidden" name="ayuda" value="configuration">
                <div class="col-12 col-lg-6 fadeInUp" data-wow-delay="100ms">
                    <input type="text" name="name" class="form-control mb-30" placeholder="Titulo" value="<?= $miLocal['name'] ?>">
                </div>
                <div class="col-6 fadeInUp" data-wow-delay="100ms">
                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                </div>
                <div class="col-<?= ($values)?'6':'12'?> text-center fadeInUp" data-wow-delay="100ms">
                    <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                </div>
                <?php
                   if($values):
                ?>
                    <div class="col-6 text-center fadeInUp" data-wow-delay="100ms">
                        <form action="ayuda" method="post">
                            <input type="hidden" name="ayuda" value="noMostrar">
                            <input type="hidden" name="local" value="<?= $miLocal['id'] ?>">
                            <input type="hidden" name="seccion" value="<?= $section['id'] ?>">
                            <button type="submit"  class="btn roberto-btn mt-15"><i class="fa fa-eye-slash"></i> No mostrar</button>
                        </form>
                    </div>
                <?php
                    endif;
                ?>
            </div>
        </form>
    </div>
</div>