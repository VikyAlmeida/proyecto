<div class="roberto-contact-form-area" style="margin: 2em;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Form -->
                <div class="roberto-contact-form">
                    <form action="ayuda" method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <input type="hidden" name="local" value="<?= $miLocal['id'] ?>">
                            <input type="hidden" name="section" value="<?= $section['id'] ?>">
                            <input type="hidden" name="ayuda" value="configuration">
                            <div class="col-12 col-lg-6 fadeInUp" data-wow-delay="100ms">
                                <input type="text" name="name" class="form-control mb-30" placeholder="Titulo" value="<?= $miLocal['name'] ?>">
                            </div>
                            <div class="col-6 fadeInUp" data-wow-delay="100ms">
                                <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                            </div>
                            <div class="col-12 text-center fadeInUp" data-wow-delay="100ms">
                                <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>