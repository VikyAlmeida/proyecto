<header class="header-area">
        <div class="search-form d-flex align-items-center">
            <div class="container">
                <form action="index.html" method="get">
                    <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
                    <button type="submit"><i class="icon_search"></i></button>
                </form>
            </div>
        </div>
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="robertoNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="inicio"><img src="./vistas/img/logo.png" alt="" width="70"></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li><a class="active" href="inicio">Inicio</a></li>
                                    <li><a href="categorias">Categorias</a></li>
                                    <li><a href="establecimientos">Establecimientos</a></li>
                                <?php if (isset($_SESSION['usuario'])): ?>
                                    <li><a href="#">- Mi area</a>
                                        <ul class="dropdown">
                                            <li><a href="perfil">- Perfil</a></li>
                                            <?php if ($_SESSION['usuario']["role_id"] == 1): ?><li><a href="menu">- Area admin</a></li>
                                            <?php elseif ($_SESSION['usuario']["role_id"] == 2): ?><li><a href="menu">- Mis locales</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="book-now-btn ml-3 ml-lg-5">
                                    <a href="logout">Desconectarse <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <?php else: ?>
                                </ul>
                                <div class="book-now-btn ml-3 ml-lg-5">
                                    <a href="login">Iniciar sesion <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>