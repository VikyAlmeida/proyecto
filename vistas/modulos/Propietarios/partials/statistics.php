<?php
    $establishmentController = new establishmentController();
    $establishments = $establishmentController->getEstablishments('SELECT * FROM establisments where id_owner = '.$_SESSION["usuario"]["id"]);
    //graficos
    $visitsClientOrNot = $establishmentController->getGraphicsData('SELECT if(count(date_of_booking)>0, 1, 0) as client
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by v.id_user');
                                                                    
    $visitsByMonth = $establishmentController->getGraphicsData('SELECT month(v.created_at) as mes, count(id_user) as visit
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by month(created_at)');

    $establishmentMoreVisited = $establishmentController->getGraphicsData('SELECT e.name, count(v.id) as visits
                                                                    FROM visits v join establisments e on v.id_establishment = e.id
                                                                    where id_owner = 2
                                                                    group by e.id');

    $categoriesEstablishment = $establishmentController->getGraphicsData('SELECT id_category, c.name as name, count(e.id) as establishmentByCategory 
                                                                    FROM establisments e join categories c on c.id=id_category 
                                                                    group by id_category;');
    $visitsClientOrNot_json = json_encode($visitsClientOrNot);
    $visitsByMonth_json = json_encode($visitsByMonth);
    $establishmentMoreVisited_json = json_encode($establishmentMoreVisited);
    $categories_json = json_encode($categoriesEstablishment);
?> 
<div class='container'>
    <div class="row" style='margin:1em;'>
        <div class="col-sm-6 col-lg-6">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <p style='color:#4688C8'>Mis clientes</p>
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
        <div class="col-sm-6 col-lg-6">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <p style='color:#4688C8'>Visitas por mes</p>
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
    </div> 
    <div class="row" style='margin:1em;'>
        <div class="col-sm-6 col-lg-6">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <p style='color:#4688C8'>Establecimientos mas activos</p>
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
        
        <div class="col-sm-6 col-lg-6">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div style='display:flex;width:100%;'>
                        <div style="width:50%;">
                            <p style='color:#4688C8'>Categorias</p>
                        </div>
                        <div style="width:50%;justify-content:center">
                            <div id='container'>
                                <canvas id="myChart4"></canvas>
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
    let typeOfUserInVisits = { 'client': 0, 'notClient':0 };
    const visitsClientOrNot = <?= $visitsClientOrNot_json ?>;
    visitsClientOrNot.map((value) => value.client == 1 ? typeOfUserInVisits['client']++:typeOfUserInVisits['notClient']++);

    const grafica1 = document.getElementById('myChart1').getContext('2d');
    const myChart1 = new Chart(grafica1,{
        type:'doughnut',
        data:{
            labels:['Clientes','No clientes'],
            datasets:[{
                label: 'num',
                data: [typeOfUserInVisits['client'],typeOfUserInVisits['notClient']], 
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
    // segundo grafico
    let i = 0;
    let a = 0;
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const date = new Date();
    const threeMonthActuals = [ date.getMonth(), date.getMonth()-1<0?meses.length-1:date.getMonth()-1, date.getMonth()-2<0?meses.length-2:date.getMonth()-2 ];

    const visitsByMonth = <?= $visitsByMonth_json ?>;
    let result = visitsByMonth.map((value) => threeMonthActuals.indexOf(parseInt(value.mes,10)-1)>-1 ? value : false);
    result = result.filter(value => value !== false);
    result = threeMonthActuals.sort(( a, b ) => { return a - b; }).map((mes) => { 
        a=i;
        if (result[i]) {
            if ((mes)+1 == result[i].mes) {
                i++;
                return result[a].visit;
            } else {
                return 0;
            }
        }
        return 0;
    })
    const grafica2 = document.getElementById('myChart2').getContext('2d');
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
    // tercer grafico
    const establishmentMoreVisited = <?= $establishmentMoreVisited_json ?>;
    const grafica3 = document.getElementById('myChart3').getContext('2d');
    const myChart3 = new Chart(grafica3,{
        type:'polarArea',
        data:{
            labels: establishmentMoreVisited.map((value)=>value.name),
            datasets: [{
                data: establishmentMoreVisited.map((value)=>value.visits),
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(54, 162, 235)'
                ]
            }]
        },
        options: {
            resposive:true
        }
    });
    // cuarto grafico
    const array_categories = <?= $categories_json ?>;
    const grafica4 = document.getElementById('myChart4').getContext('2d');
    const myChart4 = new Chart(grafica4,{
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
