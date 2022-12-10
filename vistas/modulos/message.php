<?php
    $messengerController = new MessengerController();

    $userController = new userController();
    $users = $userController->getUsers('SELECT * FROM users where id not like "'.$_SESSION["usuario"]["id"].'"');
?>
<div style="background-color:#0E2737;padding:5em;color:white">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title">Mensajeria</h1>
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

<div class="roberto-contact-form-area section-padding-100">
        <div class="container" style="border:1px solid #4488C7;padding:5em">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-6" >
                                        <label for="message" class="form-label">Mensaje</label>
                                        <textarea name="message" id="message" cols="30" rows="10" style="width: 100%;"></textarea>
                                        <label for="users" class="form-label">Usuarios</label>
                                        <select name="receiver" id="users" style="width: 100%;">
                                            <option value="0">Seleccione un usuario</option>
                                            <?php foreach($users as $user): ?>
                                                <option value="<?=$user['id']?>" onchange="rellenar('1')">
                                                    <?=$user['dni']?> - <?=$user['name']?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="transmitter" value="<?=$_SESSION['usuario']['id']?>"><br><br>
                                        <button  style="width: 100%;" type="submit" class="btn roberto-btn mt-15">Enviar</button>
                                </div>
                                <div class="col-6" >
                                    <img src="./vistas/img/ayamonte/5.jpg" alt="">
                                </div>
                            </div>
                                <?php
                                    $messengerController->send();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>