<?php
    $categoryController = new CategoryController();
    $establishmentController = new EstablishmentController();
    $establishments = $establishmentController->getEstablishments('SELECT e.*, c.name as nameCategory, i.img as image FROM (establisments e JOIN categories c on e.id_category=c.id) JOIN establisments_image i ON i.id_establishment = e.id where i.favorite = true');
    $establishments_json = json_encode($establishments);
?>
<script>
    let page = localStorage.getItem('page') || 1; //pagina en la que estoy
    const pageSize = 6;
    const elements = <?= $establishments_json ?>;
    console.log(elements);
    const pages = Math.ceil(elements.length/pageSize); // paginas que necesito
    let init = (page-1)*pageSize;
    let finish = init + pageSize; 
    function next(page) {
        page = parseInt(localStorage.getItem('page')) || 1;
        if (Math.ceil(elements.length/pageSize)<= parseInt(localStorage.getItem('page'))) return 0;
        localStorage.setItem('page', page+1);
        location.reload();
    }
    function before(page) {
        page = localStorage.getItem('page')-1;
        if (page <= 0) return 0;
        localStorage.setItem('page', page);
        location.reload();
    }
    function pageNum(page) {
        localStorage.setItem('page', page);
        location.reload();
    }
</script>
<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image:url(./vistas/img/ayamonte/1.png)" onload="load()">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center" style="background-color: #388ffa85;padding:4em;">
                        <h1 class="page-title" style="font-size: 90px;">Establecimientos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <section class="roberto-project-area mt-50">
        <div class="container">
            <div class="row">
                <script>
                    for (var i = init; i < finish; i++) {
                        if (elements[i]){
                            document.write(`<div class="col-6 mt-50">`);
                            document.write(`    <div class="single-project-slide active bg-img" style="height:18em;background-image:url(${elements[i].image});">`);
                            document.write(`        <div class="project-content">`);
                            document.write(`            <div class="text">`);
                            document.write(`                <h5>${elements[i].name}</h5>`);
                            document.write(`                <h6>${elements[i].nameCategory}</h6>`);
                            document.write(`            </div>`);
                            document.write(`        </div>`);
                            document.write(`        <div class="hover-effects">`);
                            document.write(`            <div class="text">`);
                            document.write(`                <h5>${elements[i].name}</h5>`);
                            document.write(`                <h6>${elements[i].nameCategory}</h6>`);
                            document.write(`                <p>${elements[i].location}</p>`);
                            document.write(`            </div>`);
                            document.write(`            <a href="establecimiento-${elements[i].slug}" class="btn project-btn">Ver mas <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>`);
                            document.write(`        </div>`);
                            document.write(`    </div>`);
                            document.write(`</div>`);
                        }
                    }
                </script>
            </div>
            <nav class="roberto-pagination fadeInUp mb-100" data-wow-delay="1000ms">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" onclick="before(page)"><i class="fa fa-angle-left"></i> Atras</a></li>
                    <script>
                        for (var i = 1; i <= pages; i++) {
                            document.write(`<li class="page-item"><a class="page-link" onclick='pageNum(${i})'>${i}</a></li>`);
                        }
                    </script>
                    <li class="page-item"><a class="page-link" onclick="next(page)">Siguiente <i class="fa fa-angle-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </section>