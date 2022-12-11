<?php

    class MessengerController {
        public function getMessages($query){
            if ($query == null) $query = 'SELECT * FROM messenger_service';
            
            $registros = MessengerModel::getMessages($query);
            return $registros;
        }
    
        public function getMessage($field, $value) {        
            $registros = MessengerModel::getMessage("",$field, $value);
            return $registros;
        }

        public function send(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $receiver = Generales::sanar_datos($_POST["receiver"],"string",$errores,"receptor");
                $transmitter = Generales::sanar_datos($_POST["transmitter"],"string",$errores,"emisor");
                $message_text = Generales::sanar_datos($_POST["message"],"string",$errores,"mensaje");
                if(empty($errores)){
                    $datos = compact('receiver', 'transmitter', 'message_text');
                    if(MessengerModel::add($datos)):
                        echo "<script>
                                Swal.fire(
                                'Añadido!',
                                'Se ha Añadido el establecimiento con exito.',
                                'success'
                            ).then(() => window.location= 'menu');
                            </script>"; 
                    else:
                        echo "<script>
                            Swal.fire(
                                'error',
                                'Oops...!',
                                'Operación inválida.',  
                                ).then(() => window.location= 'menu');
                    </script>";
                    endif;
                } else {
                    echo "  <script>
                                Swal.fire(
                                    'error',
                                    'Estos son los siguientes errores: <br> $errores',  
                                ).then(() => window.location= 'message');
                            </script>";
                }
            }
        }
        public function changeStatus($status, $id){
            MessengerModel::updated($status, $id);
            echo "<script> window.location= 'menu' </script>"; 
        }
    }