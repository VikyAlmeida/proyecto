<?php
    include('./controladores/template.controller.php');
    include('./controladores/rutas.controller.php');
    include('./controladores/usuario.controller.php');
    include('./controladores/libreria.controller.php');
    include('./controladores/categoria.controller.php');
    include('./controladores/secciones.controller.php');
    include('./controladores/redes.sociales.controller.php');
    include('./controladores/formato.controller.php');
    include('./controladores/rol.controller.php');
    include('./controladores/establecimientos.controller.php');

    include('./modelos/usuario.model.php');
    include('./modelos/categoria.model.php');
    include('./modelos/formato.model.php');
    include('./modelos/secciones.model.php');
    include('./modelos/redes.sociales.model.php');
    include('./modelos/rol.model.php');
    include('./modelos/establecimientos.model.php');

    session_start();
    $template = new ControllerTemplate();
    $template->ctrTemplate();