<div class="col-12" style='background-color: blue;'>
    <div class="roberto-contact-form">
        <form action="ayuda" method="post" enctype="multipart/form-data" >
            <div class="row" style="padding:2em;">
                <input type="hidden" name="local" value="<?= $miLocal['id'] ?>">
                <input type="hidden" name="section" value="<?= $section['id'] ?>">
                <input type="hidden" name="ayuda" value="configuration">
                <div class="col-12 col-lg-6 fadeInUp" data-wow-delay="100ms">
                    <input type="text" name="name" class="form-control mb-30" placeholder="Texto" value="Reserva y vente">
                </div>
                <div class="col-6 fadeInUp" data-wow-delay="100ms">
                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                </div>
                <div class="col-12 text-center fadeInUp" data-wow-delay="100ms">
                    <img src="<?= $img ?>" alt="">
                </div>
                <div class="col-12 text-center fadeInUp" data-wow-delay="100ms">
                    <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                </div>
            </div>
                <?php
                    $sectionController->create();
                ?>
        </form>
    </div>
</div>