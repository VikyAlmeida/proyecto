<?php    
    if (!isset($_SESSION['usuario'])) {
        header("Location: inicio");
    }

    $establishmentController = new EstablishmentController();
    $publicacionesController = new PostController();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if ($_POST['ayuda'] === 'mensajeriaAcciones'):

            $messengerController = new MessengerController();
            $status = $_POST['accion'] == "aceptar"?true:false;
            $messengerController->changeStatus($status, $_POST['id']);

        elseif($_POST['ayuda'] === 'imgFavorite'):

            if ($_POST['accion'] == 1) echo "<script>
                                                    Swal.fire(
                                                    'error',
                                                    'Oops...!',
                                                    'Operación inválida. Tiene que haber minimo una imagen favorita',  
                                                    ).then(() => window.location= '$ruta');
                                            </script>";
            $establishmentController->favoriteImage($_POST['id']);

        elseif($_POST['ayuda'] === 'addImage'):
            echo $establishmentController->addPhoto($_POST['id'], $_FILES["file"]);

        elseif($_POST['ayuda'] === 'showPost'):
            echo $publicacionesController->updated($_POST['id'], 'show', $_POST['accion']);

        elseif($_POST['ayuda'] === 'valoration'):
            $establishmentController->valoration($_POST['value'], $_POST['establishment']);

        endif;
    }
    else {
        header("Location: http://localhost/proyecto/inicio");
    }
    
