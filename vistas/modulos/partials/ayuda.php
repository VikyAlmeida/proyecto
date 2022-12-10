<?php    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if ($_POST['ayuda'] === 'mensajeriaAcciones'):
            $messengerController = new MessengerController();
            if (!isset($_SESSION['usuario'])) {
                header("Location: http://localhost/proyecto/inicio");
            }
            
            $status = $_POST['accion'] == "aceptar"?true:false;
            $messengerController->changeStatus($status, $_POST['id']);
        else if($_POST['ayuda'] === 'valoration'):
            $establishmentController = new EstablishmentController();
            if (!isset($_SESSION['usuario'])) {
                header("Location: http://localhost/proyecto/inicio");
            }
            $establishmentController->valoration($_POST['value'], $_POST['establishment']);
        endif;
    }
    else {
        header("Location: http://localhost/proyecto/inicio");
    }
    
