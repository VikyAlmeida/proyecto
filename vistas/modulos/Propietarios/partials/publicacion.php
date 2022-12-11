<?php
    $publicacionesController = new PostController();
    $posts = $publicacionesController->getPosts(null);
?>

<div style="width:90%;margin:0 auto;">
    <h1>Publicaciones</h1>
    <button class="btn btn-info" style="margin-bottom: 1em;">Añadir publicación</button>
    <?php if ($posts): ?>
    <table class="table" id='tableMessage' style='padding:5em;margin-bottom: 5em;'>
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Mostrar</th>
                <th colspan="2" style='text-align:center;'>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($posts as $post):
            ?>
                <tr style="background-color: <?= $color ?>; height:0.5em">
                    <td><img src="<?=$post['img']?>" alt="img-<?=$post['img']?>"></td>
                    <td><?=$post['title']?></td>
                    <td><?php $post['showPost']? '<i class="fa fa-eye" aria-hidden="true"></i>':'<i class="fa fa-eye-slash" aria-hidden="true"></i>'; ?></td>
                    <?php if ($message['status'] === null): ?>
                        <td style='text-align:right;width:15%;'>
                            <form action="ayuda-message" method="post">
                                <input type="hidden" name="accion" value="aceptar">
                                <input type="hidden" name="id" value="<?=$message['id']?>">
                                <input type="hidden" name="ayuda" value="mensajeriaAcciones">
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                        </td>
                        <td style='text-align:left;width:15%'>
                            <form action="ayuda-message" method="post">
                                <input type="hidden" name="accion" value="declinar">
                                <input type="hidden" name="id" value="<?=$message['id']?>">
                                <input type="hidden" name="ayuda" value="mensajeriaAcciones">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    <?php else: ?>
                        <td colspan="2" style='text-align:center;width:15%;'>
                            <?= $message['status'] ? 'Aceptada':'Declinada';  ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <h3>No hay publicaciones</h3>
    <?php endif; ?>
</div>