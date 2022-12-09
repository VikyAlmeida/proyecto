<div class="breadcrumb-area bg-img bg-overlay jarallax" style="margin-top:1em;background-color:#718F94;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Perfil</h2>
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
<?php
    $userController = new userController();
    $user = $userController->getUser('id',$_SESSION["usuario"]["id"]);
    $rolController = new RolController();
    $role = $rolController->getRole('id', $user['id_role']);
    $ruta = explode("-", $_GET["ruta"]);
    if (isset($ruta[1]) && $ruta[1] == "edit") :
?> 
<div class="roberto-contact-form-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="name" class="form-control mb-30" placeholder="Tu nombre" value=<?= $user['name'] ?>>
                                </div>
                                <div class="col-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="text" name="dni" class="form-control mb-30" placeholder="Tu DNI" value=<?= $user['dni'] ?>>
                                </div>
                                <div class="col-6 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="email" name="email" class="form-control mb-30" placeholder="Tu email" value=<?= $user['email'] ?>>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="password" name="password" class="form-control mb-30" placeholder="Tu constrasena">
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="100ms">
                                    <input type="password" name="newpassword" class="form-control mb-30" placeholder="Tu nueva constrasena">
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn roberto-btn mt-15">Actualizar</button>
                                </div>
                            </div>
                                <?php
                                    $userController->updated($user['id']);
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    else :
?>
<div class="col-12 col-lg-12" style='margin:1em; justify-content:center;'>
    <section class="roberto-about-area" >
        <div class="container"style="border: 1px solid black;padding:1em; border-radius: 3em">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="section-heading wow fadeInUp bt-25" data-wow-delay="100ms">
                        <h6><a class="btn btn-primary" href="perfil-edit">Editar</a></h6>
                        <h2><?= $user['name'] ?></h2>
                        <h4 style='color:#46889F '><?= $role['name'] ?></h4>
                        <h4><?= $user['email'] ?></h4>
                        <h4><?= $user['dni'] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
    endif; 
?>