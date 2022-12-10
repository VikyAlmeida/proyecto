<?php
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories(null);
    $categories_json = json_encode($categories);
?>
<script>
    let page = localStorage.getItem('page') || 1; //pagina en la que estoy
    const pageSize = 3;
    const elements = <?= $categories_json ?>;
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
<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image:url(./vistas/img/ayamonte/1.png)">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center" style="background-color: #388ffa85;padding:4em;">
                        <h1 class="page-title" style="font-size: 90px;">Categorias</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-50">
    <div class="row">
            <script>
                for (var i = init; i < finish; i++) {
                    if (elements[i]){
                        document.write(`<div class="col-4">`);
                        document.write(`    <div class="single-service--area mb-50 wow fadeInUp" data-wow-delay="50ms" style="width:13em">`);
                        document.write(`        <img src="${elements[i].img}" alt="">`);
                        document.write(`        <h5>${elements[i].name}</h5>`);
                        document.write(`    </div>`);
                        document.write(`</div>`);
                    }
                }
            </script>
    </div>
    <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="1000ms">
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