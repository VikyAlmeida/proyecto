<?php 
    $local = new establishmentController();
    $userController = new userController();
    $publicacionesController = new PostController();
    $categoryController = new CategoryController();

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

    $posts = $publicacionesController->getPosts('SELECT * FROM posts where showPost = 1 and id_establishment = '.$establishment['id']);
    $owner = $userController->getUser('id', $establishment['id_owner']);
?>
<!-- banner nombre img -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image:url(./vistas/img/ayamonte/1.png)">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center" style="background-color: #388ffa85;padding:4em;">
                            <h1 class="page-title" style="font-size: 90px;">cds</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <h6>About Us</h6>
                        <h2>Welcome to <br>Roberto Hotel Luxury</h2>
                    </div>
                    <div class="about-us-content mb-100">
                        <h5 class="wow fadeInUp" data-wow-delay="300ms">With over 340 hotels worldwide, NH Hotel Group offers a wide variety of hotels catering for a perfect stay no matter where your destination.</h5>
                        <p class="wow fadeInUp" data-wow-delay="400ms">Manager: <span>Michen Taylor</span></p>
                        <img src="img/core-img/signature.png" alt="" class="wow fadeInUp" data-wow-delay="500ms">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="row no-gutters">
                        <div class="room-thumbnail-slides mb-50">
                                <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="./vistas/img/ayamonte/1.png" class="d-block w-100" alt="">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="./vistas/img/ayamonte/2.jpg" class="d-block w-100" alt="">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="./vistas/img/ayamonte/3.png" class="d-block w-100" alt="">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="./vistas/img/ayamonte/1.png" class="d-block w-100" alt="">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="./vistas/img/ayamonte/3.png" class="d-block w-100" alt="">
                                        </div>
                                    </div>

                                    <ol class="carousel-indicators">
                                        <li data-target="#room-thumbnail--slide" data-slide-to="0" class="active">
                                            <img src="./vistas/img/ayamonte/1.png" class="d-block w-100" alt="">
                                        </li>
                                        <li data-target="#room-thumbnail--slide" data-slide-to="1">
                                            <img src="./vistas/img/ayamonte/2.jpg"" class="d-block w-100" alt="">
                                        </li>
                                        <li data-target="#room-thumbnail--slide" data-slide-to="2">
                                            <img src="./vistas/img/ayamonte/3.png" class="d-block w-100" alt="">
                                        </li>
                                        <li data-target="#room-thumbnail--slide" data-slide-to="3">
                                            <img src="./vistas/img/ayamonte/1.png" class="d-block w-100" alt="">
                                        </li>
                                        <li data-target="#room-thumbnail--slide" data-slide-to="4">
                                            <img src="./vistas/img/ayamonte/2.jpg" class="d-block w-100" alt="">
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Imagenes aleatorias -->
    <section class="roberto-blog-area >
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <h6>Our Blog</h6>
                        <h2>Latest News &amp; Event</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/2.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Learn How To Motivate Yourself</a>
                        <p>How many free autoresponders have you tried? And how many emails did you get through using them?</p>
                        <a href="index.html" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/3.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">What If Let You Run The Hubble</a>
                        <p>My point here is that if you have no clue for the answers above you probably are not operating a followup.</p>
                        <a href="index.html" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <a href="#" class="post-thumbnail"><img src="img/bg-img/4.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Six Pack Abs The Big Picture</a>
                        <p>Some good steps to take to ensure you are getting what you need out of a autoresponder include…</p>
                        <a href="index.html" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!-- Reservar -->
    <div style="background-color:#0E2737;color:white;width:100%;height:30%;padding:0;">
        <div class="row h-100 align-items-center">
            <div class="col-6">
                <div class="breadcrumb-content text-center">
                    <h1 class="page-title">Reservar</h1>
                    <form action="">
                        <input type="datetime-local" class="form-control" name="dateBooking" style="margin:0em;padding:0;width: 30%;height:3.3em;">
                        <input type="submit" class="btn roberto-btn mt-15" value="Reserva" style="padding:0;margin:0em;">
                    </form>
                </div>
            </div>
            <div class="col-6"style="width:100%;height:10%;padding:0;">
                <img src="./vistas/img/ayamonte/1.png" alt=""style="width:100%;height:20em;padding:0;">
            </div>
        </div>
    </div>
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