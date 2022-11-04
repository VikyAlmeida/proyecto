<?php
class ControllerRutas{
    public function ctrRuta()
    {
        $rutas = [
            "comunes" => ['inicio','categorias','establecimientos'],
            "noLogueado" => ['login', 'registro'],
            "logueado" => [
                "comunes" => ['logout','perfil'],
                "admin" => ['menu', 'categorias','redesSociales','secciones'],
                "propietario" => ['menu', 'custom'],
            ],
        ];

        if (isset($_SESSION['usuario'])) {
            $role = $_SESSION['usuario']['role_id'];
        }

        if(isset($_GET["ruta"])) {
            $ruta = explode("-", $_GET["ruta"])[0];
            if (!isset($role) && in_array($ruta, $rutas['noLogueado'])): include("./vistas/modulos/".$ruta.".php");
            elseif (isset($role)):
                if (in_array($ruta, $rutas['logueado']['admin']) && $role == 1): include("./vistas/modulos/Admin/".$ruta.".php");
                elseif (in_array($ruta, $rutas['logueado']['propietario']) && $role == 2): include("./vistas/modulos/Propietarios/".$ruta.".php");
                elseif (in_array($ruta, $rutas['logueado']['comunes'])): include("./vistas/modulos/".$ruta.".php");
                else: include("./vistas/modulos/inicio.php");
                endif;
            elseif (in_array($ruta, $rutas['comunes'])): include("./vistas/modulos/".$ruta.".php");
            else:
                include("./vistas/modulos/404.php");
            endif;
        }
    }
}