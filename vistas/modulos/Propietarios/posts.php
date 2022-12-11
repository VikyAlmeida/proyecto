<div style="background-color:#0E2737;padding:5em;color:white">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title">Post</h1>
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
    $publicacionesController = new PostController();
    $ruta = explode("-", $_GET["ruta"]);
    if ($ruta[1] == "new") :
?>
<script>
    const seleccionArchivos = document.querySelector("#seleccionArchivos"),
    imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
    console.log(seleccionArchivos)

    // Escuchar cuando cambie
        postsseleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = postsseleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        postsimagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    postsimagenPrevisualizacion.src = objectURL;
    });
</script>
<div class="roberto-contact-form-area" style="margin-top:2em;">
        <div class="container" style="border:1px solid #4488C7;padding:5em">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-6" >
                                    <input type="hidden" name="id_establishment" value="<?= $_SESSION['local']['id']?>" >
                                    <label for="title" class="form-label">Titulo</label>
                                    <input type="text" class="form-label" name="title" id='title' style="width: 100%;height:5%;">
                                    <label for="text" class="form-label">Texto</label>
                                    <textarea name="text" id="text" cols="30" rows="10" style="width: 100%;"></textarea>
                                    <label for="show" class="form-label">
                                        ¿ Desea mostrar esta publicacion ? 
                                        <input type="checkbox" name="show" id="show">
                                    </label>
                                    <input type="hidden" name="transmitter" value="<?=$_SESSION['usuario']['id']?>"><br><br>
                                </div>
                                <div class="col-6">
                                    <img src="./vistas/img/ayamonte/5.jpg" alt="" id="imagenPrevisualizacion"style="height:280px;">
                                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria" id="seleccionArchivos" accept="image/*">
                                </div>
                                <div class="col-12">
                                        <button  style="width: 100%;" type="submit" class="btn roberto-btn mt-15">Añadir post</button>
                                </div>
                            </div>
                                <?php
                                    $publicacionesController->create();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php 
    elseif ($ruta[2] == 'edit'): 
        $post =$publicacionesController->getPost('id',$ruta[1]);
?>
<div class="roberto-contact-form-area" style="margin-top:2em;">
        <div class="container" style="border:1px solid #4488C7;padding:5em">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-6" >
                                    <input type="hidden" name="id_establishment" value="<?= $_SESSION['local']['id']?>" >
                                    <label for="title" class="form-label">Titulo</label>
                                    <input type="text" class="form-label" name="title" id='title' value="<?= $post['title'] ?>" style="width: 100%;height:5%;">
                                    <label for="text" class="form-label">Texto</label>
                                    <textarea name="text" id="text" cols="30" rows="10" style="width: 100%;"><?= $post['text'] ?></textarea>
                                    <label for="show" class="form-label">
                                        ¿ Desea mostrar esta publicacion ? 
                                        <input type="checkbox" name="show" id="show" <?= $post['showPost']==1? 'checked' : ''; ?>>
                                    </label>
                                    <input type="hidden" name="id" value="<?=$post['id']?>"><br><br>
                                    <input type="hidden" name="img" value="<?=$post['img']?>"><br><br>
                                </div>
                                <div class="col-6">
                                    <img src="<?= $post['img'] ?>" alt="" id="imagenPrevisualizacion"style="height:280px;">
                                    <input type="file" name="file" class="form-control mb-30" placeholder="Imagen de la categoria" id="seleccionArchivos" accept="image/*">
                                </div>
                                <div class="col-12">
                                        <button  style="width: 100%;" type="submit" class="btn roberto-btn mt-15">Actualizar post</button>
                                </div>
                            </div>
                                <?php
                                    $publicacionesController->updated();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php 
    else :
        $publicacionesController->deleted($ruta[1]);
    endif; 
?>
