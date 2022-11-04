<?php
    include('./controladores/template.controller.php');
    include('./controladores/rutas.controller.php');
    include('./controladores/usuario.controller.php');
    include('./controladores/libreria.controller.php');

    include('./modelos/usuario.model.php');

    session_start();
    $template = new ControllerTemplate();
    $template->ctrTemplate();