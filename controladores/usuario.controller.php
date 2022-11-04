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
                    $_SESSION["usuario"]["role_id"]=$userBd["role_id"];
                    ?>
                        <script>
                            window.location='inicio';
                        </script>
                    <?php
                else:
                endif;
            else:
                unset($_SESSION["usuario"]);
                echo "<script>alert('Contraseña incorrecta');window.location='login'</script>";
            endif;
        }
    }
}