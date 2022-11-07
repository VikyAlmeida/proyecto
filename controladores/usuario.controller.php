<?php
class userController{
    public function registro() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $condicion = "email like '".$_POST["email"]."'";
            $registros = UserModel::where("users",$condicion);
            if(!$registros):
                $nombre = $_POST["name"];
                $dni = $_POST["dni"];
                $email = $_POST["email"];
                $pass = Generales::encriptar($_POST["pass"]);
                $datos = compact('nombre','email', 'pass','dni');
                if(UserModel::insert("users",$datos)):
                    echo "<script>alert('Se te ha dado de alta');window.location='login'</script>";
                else:
                    echo "<script>alert('Ha ocurrido un error');window.location='registro'</script>";
                endif;
            else:
                echo "<script>alert('Ese usuario ya existe');window.location='registro'</script>";
            endif;
        }
    }
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $query = "email like '".$_POST["email"]."'";
            $userBd = UserModel::where("users",$query);
            if($userBd):
                if(password_verify($_POST["password"], $userBd['password'])):
                    $_SESSION["usuario"]["id"]=$userBd["id"];
                    $_SESSION["usuario"]["name"]=$userBd["name"];
                    $_SESSION["usuario"]["id_role"]=$userBd["id_role"];
                    echo "<script>
                            Swal.fire(
                            'Loggued!',
                            'Has iniciado sesion.',
                            'success'
                        ).then(() => window.location= 'inicio');
                        </script>"; 
                else:
                    unset($_SESSION["usuario"]);
                    echo "<script>
                           Swal.fire(
                             'error',
                             'Oops...!',
                             'Contraseña incorrecta.',  
                             ).then(() => window.location= 'login');
                   </script>";
                endif;
            else:
                unset($_SESSION["usuario"]);
                echo "<script>
                       Swal.fire(
                         'error',
                         'Oops...!',
                         'Operación inválida.',  
                         ).then(() => window.location= 'login');
               </script>";
            endif;
        }
    }
    public function getUser($field, $value){
        $condition = $field." like '".$value."'";
        $registro = UserModel::where("users",$condition);
        return $registro;
    }
    public function updated($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $condicion = "id like '".$_SESSION['usuario']["id"]."'";
            $userBd = UserModel::where("users",$condicion);
            $nombre = $_POST["name"];
            $dni = $_POST["dni"];
            $email = $_POST["email"];
            if (isset($_POST["newpassword"]) && password_verify($_POST["password"], $userBd['password'])):
                $pass = Generales::encriptar($_POST["newpassword"]);
            else:
                $pass = Generales::encriptar($_POST["password"]);
            endif;
            $datos = compact('nombre','email', 'pass','dni');
            if(UserModel::update($datos, $id)):
                echo "<script>
                        Swal.fire(
                        'Actualizado!',
                        'Se ha actualizado el perfil con exito.',
                        'success'
                    ).then(() => window.location= 'perfil');
                    </script>"; 
            else:
                echo "<script>
                       Swal.fire(
                         'error',
                         'Oops...!',
                         'Operación inválida.',  
                         ).then(() => window.location= 'perfil');
               </script>";
            endif;
        }
    }
}