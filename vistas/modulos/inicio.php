<?php
    $categoryController = new CategoryController();
    $categoriesWithLocalsMore = $categoryController->getCategories('SELECT c.id, c.name, c.img FROM categories c inner join establisments e on c.id=e.id_category group by id_category order by count(e.id) desc limit 4');
    $establishmentController = new EstablishmentController();
    $establishmentMoreActive = $establishmentController->getEstablishments('SELECT * FROM establisments order by updated_at desc limit 7');
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
                        <h5 class="wow fadeInUp" data-wow-delay="300ms">Somos una plataforma con X usuarios registrados que se encarga de promocionar a los establecimientos de ayamonte, actualmente contamos con X establecimientos distribuido en X categorias</h5>
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
                        <a href="#" class="btn roberto-btn">Ver mas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="roberto-rooms-area">
        <div class="rooms-slides owl-carousel">
            <!-- Single Room Slide -->
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url(./vistas/img//ayamonte/establisment/decimas.jpg);"></div>

                <!-- Content -->
                <div class="room-content">
                    <h2 data-animation="fadeInUp" data-delay="100ms">Decimas</h2>
                    <h3 data-animation="fadeInUp" data-delay="300ms">
                        <form>
                            <p class="clasificacion">
                              <input id="radio1" type="radio" name="estrellas" value="5"><!--
                              --><label for="radio1">★</label><!--
                              --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                              --><label for="radio2">★</label><!--
                              --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                              --><label for="radio3">★</label><!--
                              --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                              --><label for="radio4">★</label><!--
                              --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                              --><label for="radio5">★</label>
                            </p>
                        </form>
                    </h3>
                    <ul class="room-feature" data-animation="fadeInUp" data-delay="500ms">
                        <li><span><i class="fa fa-clock-o"></i> Horario</span> <span>: 30 ft</span></li>
                        <li><span><i class="fa fa-map-o"></i> Ubicacion</span> <span>: Max persion 5</span></li>
                        <li><span><i class="fa fa-check"></i> Estado</span> <span>: Wifi, Television, Bathroom</span></li>
                    </ul>
                    <a href="#" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver mas</a>
                </div>
            </div>

            <!-- Single Room Slide -->
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url(./vistas/img/bg-img/17.jpg);"></div>

                <!-- Content -->
                <div class="room-content">
                    <h2 data-animation="fadeInUp" data-delay="100ms">Best King Room</h2>
                    <h3 data-animation="fadeInUp" data-delay="300ms">125$ <span>/ Day</span></h3>
                    <ul class="room-feature" data-animation="fadeInUp" data-delay="500ms">
                        <li><span><i class="fa fa-check"></i> Size</span> <span>: 30 ft</span></li>
                        <li><span><i class="fa fa-check"></i> Capacity</span> <span>: Max persion 5</span></li>
                        <li><span><i class="fa fa-check"></i> Bed</span> <span>: King Beds</span></li>
                        <li><span><i class="fa fa-check"></i> Services</span> <span>: Wifi, Television, Bathroom</span></li>
                    </ul>
                    <a href="#" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver mas</a>
                </div>
            </div>
        </div>
    </section>
    
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
            <div class="single-project-slide active bg-img" style="background-image: <?=$background?>;">
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
                    <a href="#" class="btn project-btn">Ver mas <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>