<?php
class ControllerRutas{
    public function ctrRuta()
    {
        $rutas = [
            "comunes" => ['inicio','categorias','establecimientos', 'establecimiento'],
            "noLogueado" => ['login', 'registro'],
            "logueado" => [
                "comunes" => ['logout','perfil', 'message'],
                "admin" => ['menu', 'categorias','redesSociales','secciones', 'formato'],
                "propietario" => ['menu', 'configuracion', 'miLocal', 'posts'],
            ],
        ];

        if (isset($_SESSION['usuario'])) {
            $role = $_SESSION['usuario']['id_role'];
        }

        if (isset($_GET["partial"])) {
            $partial = $_GET["partial"];
        }

        if(isset($_GET["ruta"])) {
            $ruta = explode("-", $_GET["ruta"])[0];
            if ($ruta == "ayuda"): include("./vistas/modulos/partials/".$ruta.".php"); endif;

            if (!isset($_SESSION['usuario']) && in_array($ruta, $rutas['noLogueado'])): include("./vistas/modulos/".$ruta.".php");
            elseif (isset($_SESSION['usuario'])):
                if (in_array($ruta, $rutas['logueado']['admin']) && $role == 1): include("./vistas/modulos/Admin/".$ruta.".php");
                elseif (in_array($ruta, $rutas['logueado']['propietario']) && $role == 2): include("./vistas/modulos/Propietarios/".$ruta.".php");
                elseif (in_array($ruta, $rutas['logueado']['comunes'])): include("./vistas/modulos/".$ruta.".php");
                else: include("./vistas/modulos/".$ruta.".php");
                endif;
            elseif (in_array($ruta, $rutas['comunes'])): include("./vistas/modulos/".$ruta.".php");
            else:
                include("./vistas/modulos/404.php");
            endif;
        } else {
            include("./vistas/modulos/inicio.php");
        }
    }
}