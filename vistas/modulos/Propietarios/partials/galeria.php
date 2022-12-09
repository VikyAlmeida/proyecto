<?php 
    $imgs = $local->getImage($miLocal['id']);
?>
<style>
        #gallery div {
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 1px 1px 1px #999;
            font-style: oblique;
            text-align: center;
            float: left;
            background: green;
        }

        #gallery .first {
            background: blue;
        }

        .prev, .next {
            font-weight: bold;
            font-size:30px;
            padding:10px;
            cursor:pointer;
        }

        #container {
            text-align: center;
            width: 50%;
            margin-left: 25%;
        }
    </style>
<script>
    let options = {
        numberPerPage:1, 
        goBar:true, 
        pageCounter:true
    };
	
    paginate.init('#gallery', options);
    function show(id, color){
        document.getElementById(id).style.backgroundColor = 'white';
        document.getElementById(id).innerHTML = `<i class="fa fa-heart" style="color:${color}; font-size:90px;margin:0 auto"></i>`;
    }
    function hiddenImg(id, img) {
        document.getElementById(id).style.backgroundColor = 'transparent';
        document.getElementById(id).style.backgroundImage = `url(<img src="${img}">)`;
        document.getElementById(id).innerHTML = ``;
    }
</script>
<div style="width:90%;margin:0 auto;text-align:center">
    <h1>Galeria</h1>
    <div style="display:flex;" id="gallery">
        <?php 
            foreach($imgs as $img):
            $color = "black"; 
            if ($img['favorite']){
                $color = "red";
            }
        ?>
        <form action="" method="post" style="width:25%">
            <div 
                style="
                    margin-left: 1em;
                    height:13em; 
                    display: flex;
                    align-items: center;
                    text-align: center;
                    background-image:url('<?= $img['img'] ?>');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position:center center;" 
                id="img-<?= $img['id'] ?>"
                onmouseover="show('img-<?= $img['id'] ?>', '<?= $color ?>')"
                onmouseout="hiddenImg('img-<?= $img['id'] ?>', '<?= $img['img'] ?>')"
                onclick="submit()"
            ></div>
        </form>
        <?php endforeach;?>
    </div>
    <nav aria-label="Page navigation example" style="">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>