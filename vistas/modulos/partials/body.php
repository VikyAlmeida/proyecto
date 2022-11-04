<body>
    
    <?php
        include './vistas/modulos/partials/nav.php';
        $routes = new ControllerRutas();
        $routes->ctrRuta();
        include './vistas/modulos/partials/scripts.php';
    ?>
</body>
