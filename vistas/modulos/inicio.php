<?php
    $categoryController = new CategoryController();
    $categoriesWithLocalsMore = $categoryController->getCategories('SELECT c.id, c.name, c.img FROM categories c inner join establisments e on c.id=e.id_category group by id_category order by count(e.id) desc limit 4');
    $establishmentController = new EstablishmentController();
    $establishmentMoreActive = $establishmentController->getEstablishments('SELECT * FROM establisments order by updated_at desc limit 7');
    $userController = new userController();

    $countUser = $userController->getUsers('SELECT count(id) as users FROM users');
    $countEstablishment = $establishmentController->getEstablishments('SELECT count(id) as establishments FROM establisments');
    // $countEstablishment = $establishmentController->getEstablishments('SELECT count(id) as establishments from establishments');
    $countCategory = $categoryController->getCategories('SELECT count(id) as categories FROM categories');
?> 
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(./vistas/img/ayamonte/1.png);" data-img-url="./vistas/img/ayamonte/1.png">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Ayamonte</h2>
                                    <h6 data-animation="fadeInLeft" data-delay="200ms">Paraiso de luz</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(./vistas/img//ayamonte/2.jpg);" data-img-url="./vistas/img//ayamonte/2.jpg">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Ayamonte</h2>
                                    <h6 data-animation="fadeInLeft" data-delay="200ms">Paraiso de luz</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(./vistas/img//ayamonte/3.png);" data-img-url="./vistas/img/ayamonte/3.png">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Ayamonte</h2>
                                    <h6 data-animation="fadeInLeft" data-delay="200ms">Paraiso de luz</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="roberto-about-area section-padding-100-0">
        <div class="container mt-100">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <!-- Section Heading -->
                    <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                        <h6>Sobre nosotros</h6>
                        <h2>Bienvenido a <br>Ayamonte</h2>
                    </div>
                    <div class="about-us-content mb-100">
                        <h5 class="wow fadeInUp" data-wow-delay="300ms">
                            Somos una plataforma con <?= $countUser["users"] ?> usuarios registrados que se encarga de promocionar 
                            a los establecimientos de ayamonte, actualmente contamos con <?= $countEstablishment["establishments"] ?> establecimientos 
                            distribuido en <?= $countCategory[0]["categories"] ?> categorias.
                        </h5>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="row no-gutters">
                            <div class="col-6">
                                <div class="single-thumb" style="height:41.8%;">
                                    <img src="./vistas/img/ayamonte/4.jpg" alt="" >
                                </div>
                                <div class="single-thumb">
                                    <img src="./vistas/img/ayamonte/5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="single-thumb">
                                    <img src="./vistas/img/ayamonte/6.jpg" alt="">
                                </div>
                                <div class="single-thumb">
                                    <img src="./vistas/img/ayamonte/7.jpg" alt="" height="250">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="roberto-service-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                        <h1>Categorias con mas locales</h1>
                    </div>
                    <div class="service-content d-flex align-items-center justify-content-between">
                        <?php foreach ($categoriesWithLocalsMore as $category): ?>
                            <div class="single-service--area mb-50 wow fadeInUp" data-wow-delay="50ms" style="width:13em">
                                <img src="<?=$category['img']?>" alt="">
                                <h5><?=$category['name']?></h5>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="section-heading wow" style="text-align:right;">
                        <a href="categorias" class="btn roberto-btn">Ver mas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="roberto-project-area mb-100">
        <!-- Projects Slide -->
        <div class="section-heading wow fadeInUp mt-100" data-wow-delay="100ms">
            <h1>Mas activos</h1>
        </div>
        <div class="projects-slides owl-carousel">
            <?php 
                foreach($establishmentMoreActive as $establishment): 
                $img = $establishmentController->getImageFavorite($establishment['id']);
                $background = 'url('.$img['img'].')'; 
                $category = $categoryController->getCategory('id', $establishment['id_category']);
            ?>
            <div class="single-project-slide active bg-img" style="height:18em;background-image: <?=$background?>;">
                <div class="project-content">
                    <div class="text">
                        <h5><?=$establishment['name']?></h5>
                        <h6><?=$category['name']?></h6>
                    </div>
                </div>
                <div class="hover-effects">
                    <div class="text">
                        <h5><?=$establishment['name']?></h5>
                        <h6><?=$category['name']?></h6>
                        <p><?=$establishment['location']?></p>
                    </div>
                    <a href="establecimiento-<?= $establishment["slug"] ?>" class="project-btn" style="color:white" style="color:white">Ver mas <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>