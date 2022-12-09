<?php 
    $categoryController = new CategoryController();
    $categorias = $categoryController->getCategories(null);
    $img = $local->getImageFavorite($miLocal['id']);
?>
<div style="width:90%;justify-content:center">
    <h1>Información</h1>
    <form method="post" action="" style="display: flex;">
        <div style="width: 40%;">
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" name="name" value="<?=$miLocal['name']?>">
            <label for="inputDescription" class="form-label">Descripción</label>
            <textarea name="description" id="inputDescription" rows="3" style="width: 100%;"><?=$miLocal['description']?></textarea>
            <label for="inputCategoria" class="form-label">Categoría</label>
            <select class="form-select" name="category" id="inputCategoria">
                <?php foreach($categorias as $categoria): ?>
                    <option 
                        value="<?=$categoria['id']?>"
                        <?php if ($categoria['id'] == $miLocal['id_category']){echo 'selected';}?>
                    >
                        <?=$categoria['name']?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-info btn-lg" style="margin-left: 2em;height:3em">Actualizar</button>
        </div>
        <div style="width: 60%; margin-left:1em;text-align:center">
            <img src="<?= $img['img'] ?>" alt="">
        </div>
        <?php
            $local->edit($miLocal['id']);
        ?>
    </form>
</div>