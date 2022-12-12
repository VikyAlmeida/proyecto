<?php 
    $local = new establishmentController();
    $userController = new userController();
    $publicacionesController = new PostController();
    $categoryController = new CategoryController();
    $sectionController = new SectionController();
    $slug = '';
    for($i=0; $i<count(explode("-", $_GET["ruta"]));$i++){
        if( $i != 0 && $i != count(explode("-", $_GET["ruta"]))){
            $slug = $slug.explode("-", $_GET["ruta"])[$i].'-';
        }
    }
    $slug = substr($slug, 0, -1);
    $establishment = $local->getEstablishments('SELECT * FROM establisments where slug like "'.$slug.'"');
    $img = $local->getImageFavorite($establishment['id']);
    $category = $categoryController->getCategory('id', $establishment['id_category']);

    $valorate = $local->getValorate('SELECT * FROM valoration where id_user = '.$_SESSION["usuario"]["id"].' and id_establishment = '.$establishment['id']);

    $imgs = $local->getImage($establishment['id']);
    $posts = $publicacionesController->getPosts('SELECT * FROM posts where showPost = 1 and id_establishment = '.$establishment['id']);
    $owner = $userController->getUser('id', $establishment['id_owner']);
?>
<!-- banner nombre img -->
    <?php
        $datas = $sectionController->getConfig($establishment['id'], 'banner');
    ?>
    
    <?php 
        if($datas): 
        $imgBanner = $datas[0]['id_format'] == 1 ? $datas[0]['datum'] : $datas[1]['datum'];
        $txtBanner = $datas[0]['id_format'] == 2 ? $datas[0]['datum'] : $datas[1]['datum'];
    ?>
        <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image:url(<?php $imgBanner ?>)">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="breadcrumb-content text-center" style="background-color: #388ffa85;padding:4em;">
                                <h1 class="page-title" style="font-size: 90px;"><?= $txtBanner ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $owner['id']): ?>
    <div style="text-align:center;">
        <a href="miLocal-<?= $establishment['slug'] ?>-configuration" style="text-align: center;">
        <h4><i class="fa fa-arrow-left"></i> Ir a la configuracion</h4>
    </a>
    </div>
<?php endif; ?>

<!-- Description -->
    <section class="roberto-about-area">
        <div class="container" style="margin-top: 1em;">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <!-- Section Heading -->
                    <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                        <h6>Sobre nosotros</h6>
                        <h2>Welcome to <br><?= $establishment['name'] ?></h2>
                    </div>
                    <div class="about-us-content mb-100">
                        <h5 class="wow fadeInUp" data-wow-delay="300ms"><?= $establishment['description'] ?>.</h5>
                        <p class="wow fadeInUp" data-wow-delay="400ms">Manager: <span><?= $owner['name'] ?></span></p>
                        <img src="img/core-img/signature.png" alt="" class="wow fadeInUp" data-wow-delay="500ms">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="row no-gutters">
                            <div class="room-thumbnail-slides mb-50">
                                <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel" style="height:30em">
                                    <div class="carousel-inner" style="height:100%">
                                        <?php $i = 0; foreach($imgs as $img): ?>
                                            <div class="carousel-item <?= $i==0? 'active': '' ?>">
                                                <img src="<?= $img['img'] ?>" class="d-block" style="width: 100em"alt="">
                                            </div>
                                        <?php $i = 1; endforeach; ?>
                                    </div>

                                    <ol class="carousel-indicators">
                                        <?php $i = 0; foreach($imgs as $img): ?>
                                            <li data-target="#room-thumbnail--slide" class="<?= $i==0? 'active': '' ?>" data-slide-to="<?= $img['id'] ?>">
                                                <img src="<?= $img['img'] ?>" class="d-block" alt=""style="width: 100em">
                                            </li>
                                        <?php $i = 1; endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- Reservar -->

    <?php
        $datas = $sectionController->getConfig($establishment['id'], 'reservar');
    ?>
    <?php 
        if($datas): 
        $imgReservar = $datas[0]['id_format'] == 1 ? $datas[0]['datum'] : $datas[1]['datum'];
        $txtReservar = $datas[0]['id_format'] == 2 ? $datas[0]['datum'] : $datas[1]['datum'];
    ?>
        <div style="background-color:#0E2737;color:white;width:100%;height:30%;padding:0;">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title"><?= $txtReservar ?></h1>
                    </div>
                </div>
                <div class="col-6"style="width:100%;height:10%;padding:0;">
                    <img src="<?= $imgReservar ?>" alt=""style="width:100%;height:20em;padding:0;">
                </div>
            </div>
        </div>
    <?php endif; ?>

<!-- POST -->
    <?php if($posts): ?>
        <section class="roberto-testimonials-area mt-50" >
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="testimonial-thumbnail owl-carousel mb-100">
                            <?php foreach ($posts as $post): ?>
                                <img src="<?= $post['img'] ?>" alt="">
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Section Heading -->
                        <div class="section-heading">
                            <h6>Publicaciones</h6>
                        </div>
                        <!-- Testimonial Slide -->
                        <div class="testimonial-slides owl-carousel mb-100">
                            <?php foreach ($posts as $post): ?>
                            <!-- Single Testimonial Slide -->
                                <div class="single-testimonial-slide">
                                    <h2><?= $post['title'] ?></h2>
                                    <h5><?= $post['text'] ?></h5>
                                    <div class="rating-title">
                                        <h6><?= $owner['name'] ?> <span>- <?= $post['created_at'] ?></span></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<!-- valoration -->
    <style>
        p.clasificacion {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        p.clasificacion input {
        position: absolute;
        top: -100px;
        }

        p.clasificacion label {
        float: right;
        color: #333;
        }

        p.clasificacion label:hover,
        p.clasificacion label:hover ~ label,
        p.clasificacion input:checked ~ label {
        color: #dd4;
        }
    </style>
    <?php if(isset($_SESSION['usuario'])): ?>
        <div style="background-color:#0E2737;color:white;width:100%;height:30%;padding:0;">
            <div class="row h-100 align-items-center">
                <div class="col-6"style="width:100%;height:10%;padding:0;">
                    <img src="./vistas/img/ayamonte/1.png" alt=""style="width:100%;height:20em;padding:0;">
                </div>
                <div class="col-6">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title">Valoración</h1>
                        <form action="ayuda" method="post">
                            <p class="clasificacion"style="background-color:rgb(70, 136, 200); padding:1em">
                                <input type="hidden" name="id" value="<?=$establishment['id']?>">
                                <input type="hidden" name="ayuda" value="valoration">
                                <input type="submit" style = 'background:transparent;border:0px;' id="radio1" name="estrellas" value="5">
                                <label for="radio1" style="color: <?= $valorate['valorate']>= 5? '#dd4' :''; ?>">★</label>
                                <input type="submit" style = 'background:transparent;border:0px;' id="radio2" name="estrellas" value="4">
                                <label for="radio2" style="color: <?= $valorate['valorate']>= 4? '#dd4' :''; ?>">★</label>
                                <input type="submit" style = 'background:transparent;border:0px;' id="radio3" name="estrellas" value="3">
                                <label for="radio3" style="color: <?= $valorate['valorate']>= 3? '#dd4' :''; ?>">★</label>
                                <input type="submit" style = 'background:transparent;border:0px;' id="radio4" name="estrellas" value="2">
                                <label for="radio4" style="color: <?= $valorate['valorate']>= 2? '#dd4' :''; ?>">★</label>
                                <input type="submit" style = 'background:transparent;border:0px;' id="radio5" name="estrellas" value="1">
                                <label for="radio5" style="color: <?= $valorate['valorate'] >= 1? '#dd4' :''; ?>">★</label>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>