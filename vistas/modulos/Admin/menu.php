<?php
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories(null);

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

<div class="breadcrumb-area bg-img bg-overlay jarallax" style="margin-top:1em;background-color:#718F94;">
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
<div class='container' style="margin-top:1em;">
    <div class="row">
        <div class="col-sm-6 col-lg-4">
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
        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <h4 class="mb-0">
                                <span class="count"><?= $establishmentTotal[0] ?></span>
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
        <div class="col-sm-6 col-lg-4">
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
<div style='margin:1em;display:flex;'>
    <?php if ($categories): ?>
        <div class="col-12 col-lg-6" style='margin:0.1em;'>
            <section class="roberto-about-area" 
                        style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgba(255, 99, 132, 1)"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><a class="btn btn-primary" href="categorias-new">Add categoria</a></h6>
                                <h2>Categories</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableCategories'>
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
                                <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                    <h6><button class="btn btn-primary" href="category">Add categoria</button></h6>
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
    <?php if ($socialNetworks): ?>
        <div class="col-12 col-lg-6" style='margin:0.1em;height:10em;'>
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
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><a class="btn btn-primary" href="redesSociales-new">Add Red social</a></h6>
                                <h2>Redes sociales</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableSocialNetwork'>
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
                                <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                    <h6><button class="btn btn-primary" href="newSocialNetwork">Add red social</button></h6>
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



<div style='margin:1em;display:flex;'>
    <?php if ($formats): ?>
        <div class="col-12 col-lg-6" style='margin:0.1em'>
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
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><a class="btn btn-primary" href="formato-new">Add formato</a></h6>
                                <h2>Formatos</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em">
                                <table class="table" id='tableFormat'>
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
                                <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                    <h6><button class="btn btn-primary" href="newSocialNetwork">Add Red social</button></h6>
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

    <?php if ($sections): ?>
        <div class="col-12 col-lg-6" style='margin:0.1em'>
            <section class="roberto-about-area" style="
                        border: 1px solid black;
                        padding:1em; 
                        border-radius: 3em; 
                        height:30em; 
                        border-color:rgb(108, 255, 82)"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                <h6><a class="btn btn-primary" href="secciones-new">Add Seccion</a></h6>
                                <h2>Secciones</h2>
                            </div>
                            <div class="col-12" style="margin-top:-3em;">
                                <table class="table" id='tableSection' >
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
                                <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                                    <h6><button class="btn btn-primary" href="newSection">Add section</button></h6>
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
