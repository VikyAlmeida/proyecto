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
    $local = new establishmentController();
    $categoryController = new CategoryController();
    $sectionController = new SectionController();

    $slug = '';
    for($i=0; $i<count(explode("-", $_GET["ruta"]));$i++){
        if( $i != 0 && $i != count(explode("-", $_GET["ruta"]))-1){
            $slug = $slug.explode("-", $_GET["ruta"])[$i].'-';
        }
    }
    $slug = substr($slug, 0, -1);
    $miLocal = $local->getEstablishments('SELECT * FROM establisments where slug like "'.$slug.'"');
    $_SESSION['local'] = $miLocal;
    $categories = $categoryController->getCategory('id', $miLocal['id_category']);
    $sections = $sectionController->getSections('SELECT * FROM category_by_section cs JOIN sections s on cs.id_section=s.id where id_category = '.$miLocal['id_category']);
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
        <ul style="width:30%;margin:0 auto;" id="menuConfig">
            <li><h4 style="text-align: center;color:#4688C8">Configuración</h4></li>
            <li class="active" id="infoLink" onclick='navegar("infoLink")'>- Información</li>
            <li id="galeriaLink" onclick='navegar("galeriaLink")'>- Galeria</li>
            <li id="publicacionLink" onclick='navegar("publicacionLink")'>- Publicaciones</li>
            <li><h4 style="text-align: center;color:#4688C8">Secciones</h4></li>
            <?php if($sections): ?>
                <?php foreach( $sections as $section ): ?>
                    <li id="<?= $section['name'].'Link' ?>" onclick='navegar("<?= $section["name"]."Link" ?>")'>- <?= $section['name'] ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li><a href="establecimiento-<?= $miLocal['slug'] ?>" style="text-decoration: none;"><i class="fa fa-eye"></i> Vista previa</a></li>
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
    <?php if($sections): ?>
        <?php foreach( $sections as $section ): ?>
            <div class='divHidden' id="<?= $section['name'] ?>" style='justify-content:center;'>
                <?php include($section['file']); ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
    const section = localStorage.getItem('section') || 'info';
    navegar(section+'Link')
    function navegar(id){
        // add style
        const menu = new Array();
        const menuConfig = document.getElementById('menuConfig');
        for(let i = 0; i < menuConfig.childNodes.length; i++){
            if (menuConfig.childNodes[i].id){
                menu.push(menuConfig.childNodes[i].id);
            }
        }

        for (var i = 0; i < menu.length; i++) {
            document.getElementById(menu[i]).classList.remove("active");
            const elementDiv = menu[i].substring(0, menu[i].length - 4);
            document.getElementById(elementDiv).classList.remove("divActive");
            document.getElementById(elementDiv).classList.add("divHidden");
        }
        console.log(id);
        const elementDiv = id.substring(0, id.length - 4);
        document.getElementById(id).classList.add("active");
        document.getElementById(elementDiv).classList.add("divActive");
        localStorage.setItem('section', elementDiv);
    }
</script>