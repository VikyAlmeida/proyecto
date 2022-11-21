<?php 
    $establishmentController = new establishmentController();
    $categoryController = new CategoryController();
    $sectionController = new SectionController();
    $ruta = explode("-", $_GET["ruta"]);
    $slug = '';
    for($i=0; $i<count($ruta); $i++) {
        if ($i!=0 && $i!=count($ruta)-1):
            $slug .= $ruta[$i].'-';
        endif;
    }
    $slug = substr($slug, 0, -1);
    $establishment = $establishmentController->getEstablishments('SELECT * FROM establisments where slug like "'. $slug.'"');
    $imgFavorite = $establishmentController->getImageFavorite($establishment['id']);  
    $category = $categoryController->getCategory('id', $establishment['id_category']);
    $categories = $categoryController->getCategories(null);
    $imgs = $establishmentController->getImage($establishment['id']);         
    $imgs = $establishmentController->getImage($establishment['id']);      
    $sections = $sectionController->getSections('SELECT *
                                                    FROM sections s join category_by_section c on s.id = c.id_section
                                                    where id_category = '.$establishment['id_category']);   
?>
<div class="breadcrumb-area bg-img bg-overlay"style="background-image: url(./vistas/img/ayamonte/establisment/jungle_banner.png);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title"><?= $establishment['name'] ?></h2>
                        <h3 style='color:white;'>Categoria: <?= $category['name'] ?></h3>
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
<?php 
    if (in_array('deleted', $ruta)): 
        $establishmentController->delete($establishment['id']);
    elseif  (in_array('configuration', $ruta)): 
?>
    <div class="container">
        <h1>Galeria de imagenes</h1>
        <div class="row" style='padding:3em;'>
            <?php          
                foreach ($imgs as $img):              
            ?>    
                <div class="col-3" style="margin-top:1em;margin-bottom:1em;">
                    <div style="height:7em;background-image: url(<?= $img['img'] ?>);background-size: cover; background-position: center;"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <h1>Informacion</h1>
        <div class="row" style='padding:3em;'>
            <div class="col-12">
                <div class="roberto-contact-form-area ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Form -->
                                <div class="roberto-contact-form">
                                    <form action="" method="post" enctype="multipart/form-data" >
                                        <div class="row">
                                            <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                                <input type="text" name="name" class="form-control mb-30" placeholder="Nombre" value="<?= $establishment['name'] ?>">
                                                <select name="" id="" class="form-control mb-30" >
                                                    <?php foreach ($categories as $category):  ?>
                                                        <option value="<?= $category['id'] ?>" 
                                                        <?php if($category['id']==$establishment['id_category']): echo 'selected'; else: echo ''; endif; ?>
                                                        >
                                                            <?= $category['name'] ?>
                                                        </option>
                                                    <?php endforeach;  ?>
                                                </select>
                                            </div>
                                            <div class="col-6 wow fadeInUp" data-wow-delay="100ms" style="text-align: center">
                                                <img src="<?= $imgFavorite['img'] ?>" alt="" width="120">
                                                <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria">
                                            </div>
                                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                                <button type="submit" class="btn roberto-btn mt-15">Actualizar</button>
                                            </div>
                                        </div>
                                            <?php
                                                $sectionController->create();
                                            ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <h1>Secciones</h1>  
        <?php          
            foreach ($sections as $section):
            $sectionsByEstablishment = $sectionController->getSections('SELECT *
                                                                        FROM styles s
                                                                        where id_section = '.$section['id'].' and id_establishment='.$establishment['id'] );
        ?>  
        <script> 
            let active = <?php if($sectionsByEstablishment): echo 'true'; else: echo 'false'; endif; ?>; 
            (active)?
            document.getElementById('sectionFile'+<?= $section["id"] ?>).style.display = 'none':
            document.getElementById('sectionFile'+<?= $section["id"] ?>).style.display = 'flex';
            const changeActive = (id, status) => {
                (status)?
                document.getElementById('sectionFile'+id).style.display = 'none':
                document.getElementById('sectionFile'+id).style.display = 'flex';
                return (status)?active=false:active=true;
            }
        </script>
            <div class="row" style='margin-bottom:1em;height:20em' style='padding:3em;'>
                <div class="col-6" style="margin-top:1em;margin-bottom:1em;">
                    <form action="" method="post" enctype="multipart/form-data" >
                        <input type="checkbox" id="section<?= $section['id'] ?>" name="section<?= $section['id'] ?>" value="Bike" 
                            <?php if($sectionsByEstablishment): echo 'checked'; else: echo ''; endif; ?>
                            onclick='changeActive(<?= $section["id"] ?>, active)'
                        >
                        <label for="section<?= $section['id'] ?>"><?= $section['name'] ?></label><br>
                    </form>
                </div>
                <div class="col-6" id="sectionFile<?= $section['id'] ?>" style="margin-top:1em;margin-bottom:1em;" onload='changeActive(<?= $section["id"] ?>, active)'>
                    <div id="sectionFile<?= $section['id'] ?>">
                        <?php include($section['file']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php 
    else: 
?>

<?php 
    endif;
?>