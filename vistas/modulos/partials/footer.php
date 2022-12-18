<footer class="footer-area section-padding-80-0" style="margin-top:10%">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row align-items-baseline justify-content-between">
                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Footer Logo -->
                            <a href="#" class="footer-logo"><img src="./vistas/img/core-img/logo2.png" alt=""></a>

                            <h4>Inaya</h4>
                            <span>ayuntamiento@ayamonte.es</span>
                            <span>Plaza La Laguna, 1</span>
                            <span><a href="./guia_de_estilo/index.html">Guia de estilo</a></span>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Puedes visitar tambien</h5>

                            <!-- Single Blog Area -->
                            <div class="latest-blog-area">
                                <a href="#" class="post-title">https://ayamonte.es/</a>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php
                                    setlocale(LC_TIME, "spanish");
                                    echo strftime("%A %d de %B del %Y");
                                ?>
                                </span>
                            </div>

                            <!-- Single Blog Area -->
                            <div class="latest-blog-area">
                                <a href="#" class="post-title">https://ayamonte.sedelectronica.es/info.0</a>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> 
                                <?php
                                    setlocale(LC_TIME, "spanish");
                                    echo strftime("%A %d de %B del %Y");
                                ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-4 col-lg-2">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Links</h5>

                            <!-- Footer Nav -->
                            <ul class="footer-nav">
                                    <li><a class="active" href="inicio"><i class="fa fa-caret-right" aria-hidden="true"></i> Inicio</a></li>
                                    <li><a href="categorias"><i class="fa fa-caret-right" aria-hidden="true"></i> Categorias</a></li>
                                    <li><a href="establecimientos"><i class="fa fa-caret-right" aria-hidden="true"></i> Establecimientos</a></li>
                                <?php if (isset($_SESSION['usuario'])): ?>
                                    <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Mi area</a>
                                        <ul class="dropdown">
                                            <li><a href="perfil"><i class="fa fa-caret-right" aria-hidden="true"></i> Perfil</a></li>
                                            <?php if ($_SESSION['usuario']["id_role"] == 1): ?><li><a href="menu"><i class="fa fa-caret-right" aria-hidden="true"></i> Area admin</a></li>
                                            <?php elseif ($_SESSION['usuario']["id_role"] == 2): ?><li><a href="menu"><i class="fa fa-caret-right" aria-hidden="true"></i> Mis locales</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <li><a href="logout"><i class="fa fa-caret-right" aria-hidden="true"></i> Desconectarse </a></li>
                                <?php else: ?>
                                    <li><a href="login"><i class="fa fa-caret-right" aria-hidden="true"></i> Iniciar sesion </a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="container">
            <div class="copywrite-content">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Hecho por Victoria Almeida Calderon año <?= date('Y') ?>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>