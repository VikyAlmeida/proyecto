<style>
    li {
        font-size: large;
        color: #0E2737;
        cursor: pointer;
        line-height: 3em;
    }
    li:hover{
        color: #4688C8
    }
    .active {
        color: #4688C8;
        text-decoration: underline wavy #4688C8;
    }
    .divHidden {
        display:none;
    }
    .divActive{
        display:flex;
        width:70%;
        color:#0E2737; 
        background-color: rgb(70, 136, 200,0.2);
        border: 5px double  #0E2737;
    }
    .divActive h1{
        padding: 0.5em;
        text-align: center;
        justify-content: center;
        margin: 0 auto;
    }
</style>

<?php 
    $slug = '';
    for($i=0; $i<count(explode("-", $_GET["ruta"]));$i++){
        if( $i != 0 && $i != count(explode("-", $_GET["ruta"]))-1){
            $slug = $slug.explode("-", $_GET["ruta"])[$i].'-';
        }
    }
    $slug = substr($slug, 0, -1);
    $local = new establishmentController();
    $miLocal = $local->getEstablishments('SELECT * FROM establisments where slug like "'.$slug.'"');
?>

<div style="background-color:#0E2737;padding:5em;color:white">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title">Configuración</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item">Bienvenid@ <?= $_SESSION['usuario']['name'] ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="display:flex;padding:5em;">
    <div style="width:30%;">
        <ul style="width:30%;margin:0 auto;">
            <li class="active" id="infoLink" onclick='navegar("infoLink")'>- Información</li>
            <li id="galeriaLink" onclick='navegar("galeriaLink")'>- Galeria</li>
            <li id="publicacionLink" onclick='navegar("publicacionLink")'>- Publicaciones</li>
            <li id="seccionesLink" onclick='navegar("seccionesLink")'>- Secciones</li>
            <li id="previaLink" onclick='navegar("previaLink")'>- Vista previa</li>
        </ul>
    </div>
    <div class='divActive' id="info" style="justify-content:center">
        <?php include('./vistas/modulos/Propietarios/partials/info.php'); ?>
    </div>
   <div class='divHidden' id="galeria">
        <?php include('./vistas/modulos/Propietarios/partials/galeria.php'); ?>
    </div>
    <div class='divHidden' id="publicacion">
        <?php include('./vistas/modulos/Propietarios/partials/publicacion.php'); ?>
    </div>
    <div class='divHidden' id="secciones">
        <?php include('./vistas/modulos/Propietarios/partials/secciones.php'); ?>
    </div>
    <div class='divHidden' id="previa">
        <?php include('./vistas/modulos/Propietarios/partials/preview.php'); ?>
    </div>
</div>
<script>
    const section = localStorage.getItem('section') || 'info';
    navegar(section+'Link')

    function navegar(id){
        // add style
        const menu = new Array('infoLink', 'galeriaLink', 'publicacionLink', 'seccionesLink', 'previaLink');
        for (var i = 0; i < menu.length; i++) {
            document.getElementById(menu[i]).classList.remove("active");
            const elementDiv = menu[i].substring(0, menu[i].length - 4);
            document.getElementById(elementDiv).classList.remove("divActive");
            document.getElementById(elementDiv).classList.add("divHidden");
        }
        const elementDiv = id.substring(0, id.length - 4);
        document.getElementById(id).classList.add("active");
        document.getElementById(elementDiv).classList.add("divActive");
        localStorage.setItem('section', elementDiv);
    }
</script>