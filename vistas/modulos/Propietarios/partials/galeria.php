<?php 
    $imgs = $local->getImage($miLocal['id']);
    $imgs_json = json_encode($imgs);
?>
<script>
    let page = localStorage.getItem('page') || 1; //pagina en la que estoy
    const pageSize = 3;
    const elements = <?= $imgs_json ?>;
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
<div style="width:90%;margin:0 auto;text-align:center">
    <h1>Galeria</h1>
    <div style="display:flex;">
        <form action="ayuda" method="post" enctype="multipart/form-data" style="display: flex;">
            <input type="file" name="file" class="form-control" style="height: 100%; background-color:#e8f1f8">
            <input type="hidden" name="id" value="<?= $miLocal['id'] ?>">
            <input type="hidden" name="ayuda" value="addImage">
            <button type="submit" class="btn roberto-btn mt-15" style="height: 100%; margin-top: 0em;">Añadir imagen</button>
        </form>
    </div>
    <div style="display:flex;">
        <script>
            for (var i = init; i < finish; i++) {
                const color = elements[i].favorite? 'red' : 'black';
                if (elements[i]){
                    document.write(`<div class="single-project-slide active bg-img" style="margin:0.5em;width:25%;height:18em;background-image:url(${elements[i].img});">`);
                    document.write(`    <div class="hover-effects">`);
                    document.write(`        <div class="text">`);
                    document.write(`            <form action="ayuda" method="post">`);
                    document.write(`                <input type="hidden" name="accion" value="${elements[i].favorite} ?>">`);
                    document.write(`                <input type="hidden" name="id" value="${elements[i].id} ?>">`);
                    document.write(`                <input type="hidden" name="ayuda" value="imgFavorite">`);
                    document.write(`                <button type="submit" style="color:${color};font-size:50px;background-color: transparent;border:0px;">`);
                    document.write(`                    <i class="fa fa-heart"></i>`);
                    document.write(`                </button>`);
                    document.write(`            </form>`);
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