<?php
    $publicacionesController = new PostController();
    $posts = $publicacionesController->getPosts(null);
?>

<div style="width:90%;margin:0 auto;">
    <h1>Publicaciones</h1>
    <a href="posts-new" class="btn btn-info" style="margin-bottom: 1em;"><i class="fa fa-plus" aria-hidden="true"></i> Añadir publicación</a>
    <?php if ($posts): ?>
    <table class="table" id='tablePost' style='padding:5em;margin-bottom: 5em;'>
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Texto</th>
                <th style='text-align:right'>Mostrar</th>
                <th colspan="2" style='text-align:center;'>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($posts as $post):
            ?>
                <tr style="background-color: <?= $color ?>; height:0.5em">
                    <td><img src="<?=$post['img']?>" alt="img-<?=$post['img']?>" style="width: 25%;"></td>
                    <td><?=$post['title']?></td>
                    <td><?=$post['text']?></td>
                    <td style='text-align:right'>
                        <form action="ayuda-post" method="post">
                            <input type="hidden" name="accion" value="<?= $post['showPost'] == 1? 0 : 1; ?>">
                            <input type="hidden" name="id" value="<?=$post['id']?>">
                            <input type="hidden" name="ayuda" value="showPost">
                            <button type="submit" class="btn btn-outline-warning">
                                <?= 
                                    $post['showPost'] == 1?
                                    '<i style="color: blue" class="fa fa-eye" aria-hidden="true"></i>':
                                    '<i class="fa fa-eye-slash" aria-hidden="true"></i>';  
                                ?>
                            </button>
                        </form>
                    </td>
                    <td style='text-align:right;width:15%;'>
                        <a href='posts-<?=$post['id']?>-edit' type="button" class="btn btn-outline-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td style='text-align:left;width:15%'>
                        <a href='posts-<?=$post['id']?>-deleted' type="button" class="btn btn-outline-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <h3>No hay publicaciones</h3>
    <?php endif; ?>
</div>