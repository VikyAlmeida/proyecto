<div class="roberto-contact-form-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <h6>Si te has registrado <a href="login">inicia sesion!</a></h6>
                        <h2>Registro</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Tu nombre">
                                </div>
                                <div class="col-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="dni" class="form-control mb-30" placeholder="Tu DNI">
                                </div>
                                <div class="col-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="email" name="email" class="form-control mb-30" placeholder="Tu email">
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="password" name="pass" class="form-control mb-30" placeholder="Tu constrasena">
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Registrate</button>
                                </div>
                            </div>
                                <?php
                                    $users = new userController();
                                    $users->registro();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>