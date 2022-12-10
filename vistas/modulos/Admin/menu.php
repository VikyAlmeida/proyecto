<?php
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories(null);

    $messengerController = new MessengerController();
    $messages = $messengerController->getMessages("SELECT * FROM messenger_service where receiver like '".$_SESSION["usuario"]["id"]."'");

    $formatController = new FormatController();
    $formats = $formatController->getFormats(null);

    $socialNetworkController = new SocialNetworkController();
    $socialNetworks = $socialNetworkController->getSocialNetworks(null);

    $sectionController = new SectionController();
    $sections = $sectionController->getSections(null);

    $userController = new userController();
    $usersTotal = $userController->getUsers('SELECT count(id_role) as "usersTotal" FROM users');
    $users = $userController->getUsers('SELECT id_role, count(id_role) as "usersByRole" FROM users group by id_role');
    $users_json = json_encode($users);

    $establishmentController = new establishmentController();
    $establishmentTotal = $establishmentController->getGraphicsData('SELECT count(id) FROM establisments');
    $establishment = $establishmentController->getGraphicsData('SELECT count(id) as establishemnByCreatedDate, month(created_at) as mes FROM establisments e group by (month(created_at)) Order by created_at');
    $establishment_json = json_encode($establishment);

    $establishmentController = new establishmentController();
    $categoriesEstablishment = $establishmentController->getGraphicsData('SELECT id_category, c.name as name, count(e.id) as establishmentByCategory FROM establisments e join categories c on c.id=id_category group by id_category;');
    $categories_json = json_encode($categoriesEstablishment);
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
<script>
    const partial = localStorage.getItem('partial');
    if (partial === null) localStorage.setItem('partial', 'statistics');
    console.log(partial);
    document.getElementById(partial).style.display = "flex";

    function getPartial (value) {
        const partial =  localStorage.getItem('partial');
        localStorage.setItem("partial", value);

        document.getElementById('statistics').style.display = "none";
        document.getElementById(partial).style.display = "none";
        document.getElementById(value).style.display = "flex";
    }

</script>
<div class="container">
    <div class="row">
        <div class="col-12" >
            <ul style="display: flex; justify-content: space-between; text-align:center; padding:1em;">
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('statistics')">Estadísticas</a></li>
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('categories')">Categorias</a></li>
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('socialNetworks')">Redes sociales</a></li>
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('sections')">Secciones</a></li>
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('formats')">Formato</a></li>
                <li><a style="cursor:pointer; color: #4688C8;" onclick="getPartial('messages')">Mensajería</a></li>
            </ul>
        </div>
    </div>
</div>

<div class='container' style="padding:3em;margin:0 auto;" id="statistics">
    <div class="row" style="">
        <div class="col-sm-6 col-lg-6" style="">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <h4 class="mb-0">
                                <span class="count"><?= $usersTotal[0] ?></span>
                            </h4>
                            <p style='color:#4688C8'>Usuarios</p>
                        </div>
                        <div style="width:50%;justify-content:center">
                            <div id='container'>
                                <canvas id="myChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style='margin-bottom:2em;'>
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <h4 class="mb-0">
                                <span class="count"><?= $establishmentTotal[0][0] ?></span>
                            </h4>
                            <p style='color:#4688C8'>Establecimientos</p>
                        </div>
                        <div style="width:50%;justify-content:center">
                            <div id='container'>
                                <canvas id="myChart2" height='300'></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-12">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <h4 class="mb-0">
                                <span class="count"><?= $usersTotal[0] ?></span>
                            </h4>
                            <p style='color:#4688C8'>Members online</p>
                        </div>
                        <div style="width:50%;justify-content:center">
                            <div id='container'>
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // primer grafico
    const array_users = <?= $users_json ?>;
    const values = {
        'admin': array_users[0].usersByRole,
        'propietario': array_users[1].usersByRole,
        'usuario': array_users[2].usersByRole,
    }
    //segundo grafico
    let i = 0;
    let a = 0;
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const date = new Date();
    const threeMonthActuals = [ date.getMonth(), date.getMonth()-1<0?meses.length-1:date.getMonth()-1, date.getMonth()-2<0?meses.length-2:date.getMonth()-2 ];
    const array_establishment = <?= $establishment_json ?>;
    let result = array_establishment.map((value) => threeMonthActuals.indexOf(parseInt(value.mes,10)-1)>-1 ? value : false);
    result = result.filter(value => value !== false);
    result = threeMonthActuals.sort(( a, b ) => { return a - b; }).map((mes) => { 
        a=i;
        if (result[i]) {
            if ((mes)+1 == result[i].mes) {
                i++;
                return result[a].establishemnByCreatedDate;
            } else {
                return 0;
            }
        }
        return 0;
    })
    //segundo grafico
    const array_categories = <?= $categories_json ?>;

    const grafica1 = document.getElementById('myChart1').getContext('2d');
    const grafica2 = document.getElementById('myChart2').getContext('2d');
    const grafica3 = document.getElementById('myChart3').getContext('2d');

    const myChart1 = new Chart(grafica1,{
        type:'doughnut',
        data:{
            labels:['Administrador','Propietario','Usuario'],
            datasets:[{
                label: 'num',
                data: [values.admin, values.propietario, values.usuario], 
                backgroundColor: [
                    'hsla(347, 100%, 92%, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
            }]
        },
        options: {
            resposive:true
        }
    });
    const myChart2 = new Chart(grafica2,{
        type:'bar',
        data:{
            labels: [meses[threeMonthActuals[2]],meses[threeMonthActuals[1]],meses[threeMonthActuals[0]]],
            datasets:[{
                label: 'Locales',
                data: [result[0],result[1],result[2]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)',
                    ],
            }]
        },
        options: {
            resposive:true,
            plugins: {
                legend: {
                display: false
                }
            }
        }
    });

    const myChart3 = new Chart(grafica3,{
        type:'radar',
        data:{
            labels: array_categories.map((value)=>value.name),
            datasets: [{
                label: 'My First Dataset',
                data: array_categories.map((value)=>value.establishmentByCategory),
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
            }]
        },
        options: {
            resposive:true,
            plugins: {
                legend: {
                display: false
                }
            }
        }
    });

</script>

<div id="categories" style='display:none;'>
    <?php if ($categories): ?>
        <div class="col-12 col-lg-12" style='margin:1em;'>
            <section class="roberto-about-area" 
                        style="
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; "
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div style="margin-bottom:-3em;">
                                <h6><a class="btn btn-primary" href="categorias-new">Añadir categoria</a></h6>
                                <h2>Categories</h2>
                            </div>
                            <div >
                                <table class="table" id='tableCategories' style='padding:5em;margin-bottom: 5em;'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Name</th>
                                            <th colspan="2" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $category): ?>
                                            <tr>
                                                <td><img src="<?=$category['img']?>" alt="categoria <?=$category['id']?>"></td>
                                                <td><?=$category['name']?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='categorias-<?=$category['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                        Editar
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='categorias-<?=$category['id']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-6" style='margin:1em'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(255, 99, 132, 1)"
                >
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div>
                                    <h6><button class="btn btn-primary" href="category">Añadir categoria</button></h6>
                                    <h2>Categorias</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay categorias</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="socialNetworks" style="display: none">
    <?php if ($socialNetworks): ?>
        <div class="col-12 col-lg-12" style='margin:1em;'>
            <section class="roberto-about-area" 
                        style="
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; "
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div>
                                <h6><a class="btn btn-primary" href="redesSociales-new">Añadir Red social</a></h6>
                                <h2>Redes sociales</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableSocialNetwork' style='padding:5em;margin-bottom: 5em;'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th colspan="2" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($socialNetworks as $socialNetwork): ?>
                                            <tr>
                                                <td><img src="<?=$socialNetwork['logo']?>" alt="red social <?=$socialNetwork['id']?>" width='75' height="75"></td>
                                                <td><?=$socialNetwork['name']?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='redesSociales-<?=$socialNetwork['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                        Editar
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='redesSociales-<?=$socialNetwork['id']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-6" style='margin:1em;height:10em;'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(54, 162, 235, 1)"
            >
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div>
                                    <h6><button class="btn btn-primary" href="newSocialNetwork">Añadir red social</button></h6>
                                    <h2>Redes sociales</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay redes sociales</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="sections" style="display: none">
    <?php if ($sections): ?>
        <div class="col-12 col-lg-12" style='margin:0.1em'>
            <section class="roberto-about-area" style="
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; "
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div>
                                <h6><a class="btn btn-primary" href="secciones-new">Añadir Seccion</a></h6>
                                <h2>Secciones</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableSection' style='padding:5em;margin-bottom: 5em;'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th colspan="2" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($sections as $section): 
                                            $fileName = explode("/", $section["file"]);
                                        ?>
                                            <tr>
                                                <td><?=$section['id']?></td>
                                                <td><?=$section['name']?></td>
                                                <td style="width:1em"><?=$fileName[4]?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='secciones-<?=$section['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                        Editar
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='secciones-<?=$section['id']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-6" style='margin:1em'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgb(108, 255, 82)"
            >>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div>
                                    <h6><button class="btn btn-primary" href="newSection">Añadir section</button></h6>
                                    <h2>Secciones</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay secciones</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="formats" style='display:none;'>
    <?php if ($formats): ?>
        <div class="col-12 col-lg-12" style='margin:0.1em'>
            <section class="roberto-about-area" style="
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; "
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div>
                                <h6><a class="btn btn-primary" href="formato-new">Añadir formato</a></h6>
                                <h2>Formatos</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableFormat' style='padding:5em;margin-bottom: 5em;'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th colspan="2" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($formats as $format): $nombre = $format['name'];?>
                                            <tr>
                                                <td><?=$format['id']?></td>
                                                <td><?=$format['name']?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='formato-<?=$socialNetwork['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                        Editar
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='formato-<?=$socialNetwork['id']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-6" style='margin:1em'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(255, 206, 86, 1)"
            >
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div>
                                    <h6><button class="btn btn-primary" href="newSocialNetwork">Añadir Red social</button></h6>
                                    <h2>Formatos</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay formatos</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="messages" style='display:none;'>
    <?php if ($messages): ?>
        <div class="col-12 col-lg-12" style='margin:0.1em'>
            <section class="roberto-about-area" style="
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; "
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div>
                                <h6><a class="btn btn-primary" href="formato-new">Enviar mensaje</a></h6>
                                <h2>Mensajes</h2>
                            </div>
                            <div class="col-12">
                                <table class="table" id='tableMessage' style='padding:5em;margin-bottom: 5em;'>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>DNI</th>
                                            <th>Nombre</th>
                                            <th>Mensaje</th>
                                            <th colspan="2" style='text-align:center;'>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($messages as $menssage):
                                            $user = $userController->getUser('id', $message["transmitter"]);
                                        ?>
                                            <tr>
                                                <td><?=$user['dni']?></td>
                                                <td><?=$user['name']?></td>
                                                <td><?=$menssage['message_text']?></td>
                                                <td style='text-align:right;width:15%;'>
                                                    <a href='formato-<?=$socialNetwork['id']?>-edit' type="button" class="btn btn-outline-secondary">
                                                        <i class="fa-duotone fa-check"></i>
                                                    </a>
                                                </td>
                                                <td style='text-align:left;width:15%'>
                                                    <a href='formato-<?=$socialNetwork['id']?>-deleted' type="button" class="btn btn-outline-secondary">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="col-12 col-lg-6" style='margin:1em'>
                <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(255, 206, 86, 1)"
            >
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-12">
                                <div>
                                    <h6><button class="btn btn-primary" href="newSocialNetwork">Enviar mensaje</button></h6>
                                    <h2>Mensajes</h2>
                                </div>
                                <div class="col-12">
                                    <h3>No hay mensajes</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>
</div>