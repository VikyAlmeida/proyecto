<?php
    $messengerController = new MessengerController();

    $userController = new userController();
    $users = $userController->getUsers('SELECT * FROM users where id not like "'.$_SESSION["usuario"]["id"].'"');
?>
<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-color:#718F94;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Panel de administracion</h2>
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-12 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <select name="receiver" id="">
                                        <?php foreach($users as $user): ?>
                                            <option value="<?=$user['id']?>" onclick="rellenar('<?=$user['id_role']?>')">
                                                <?=$user['name']?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="transmitter" value="<?=$_SESSION['usuario']['id']?>">
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <textarea name="message" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Crear</button>
                                </div>
                            </div>
                                <?php
                                    $$messengerController->send();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function rellenar(rol){
            if(rol==1) document.getElementById('message').innerHTML
            elseif(rol == 2) 
            else 
        }
    </script>