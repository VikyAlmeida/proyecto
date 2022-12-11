<?php
    $establishmentController = new EstablishmentController();
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories(null);
    $ruta = explode("-", $_GET["ruta"]);
    if ($ruta[1] == "new") :
?>
<div style="background-color:#0E2737;padding:5em;color:white">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="page-title">Post</h1>
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
<div class="roberto-contact-form-area" style="margin-top:2em;">
        <div class="container" style="border:1px solid #4488C7;padding:5em">
            <div class="row">
                <div class="col-12">
                    <!-- Form -->
                    <div class="roberto-contact-form">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-12 col-lg-6" >
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-label" name="name" id='name' style="width: 100%;height:5%;">
                                    <label for="Descripción" class="form-label">Descripción</label>
                                    <textarea name="Descripción" id="text" cols="30" rows="10" style="width: 100%;"></textarea>
                                    <label for="category" class="form-label">Categoria</label>
                                    <select name="category" id="category" style="width: 100%;">
                                        <option value="0">Seleccione una categoria</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?=$category['id']?>" onchange="rellenar('1')">
                                                <?=$category['name']?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div id="map" class="form-control" style="width: 100%;height:100%"></div>
                                    <script>
                                        mapboxgl.accessToken = 'pk.eyJ1IjoidmlreTE5ODUiLCJhIjoiY2xiam1reGMzMDdiZzNxbnB1ZHNjNGVzYSJ9.lOXPJ_GwQoKHrpBXLPKfiQ';
                                        const map = new mapboxgl.Map({
                                            container: 'map',
                                            style: 'mapbox://styles/mapbox/streets-v12',
                                            center: [-79.4512, 43.6568],
                                            zoom: 8
                                        });

                                        const coordinatesGeocoder = function (query) {
                                        const matches = query.match(
                                        /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
                                        );
                                        if (!matches) {
                                        return null;
                                        }
                                        
                                        function coordinateFeature(lng, lat) {
                                            return {
                                            center: [lng, lat],
                                            geometry: {
                                                type: 'Point',
                                                coordinates: [lng, lat]
                                            },
                                                place_name: 'Lat: ' + lat + ' Lng: ' + lng,
                                                place_type: ['coordinate'],
                                                properties: {},
                                                type: 'Feature'
                                            };
                                        }
                                        
                                        const coord1 = Number(matches[1]);
                                        const coord2 = Number(matches[2]);
                                        const geocodes = [];
                                        
                                        if (coord1 < -90 || coord1 > 90) {
                                        // must be lng, lat
                                        geocodes.push(coordinateFeature(coord1, coord2));
                                        }
                                        
                                        if (coord2 < -90 || coord2 > 90) {
                                        // must be lat, lng
                                        geocodes.push(coordinateFeature(coord2, coord1));
                                        }
                                        
                                        if (geocodes.length === 0) {
                                        // else could be either lng, lat or lat, lng
                                        geocodes.push(coordinateFeature(coord1, coord2));
                                        geocodes.push(coordinateFeature(coord2, coord1));
                                        }
                                        
                                        return geocodes;
                                        };
                                        
                                        // Add the control to the map.
                                        map.addControl(
                                            new MapboxGeocoder({
                                                accessToken: mapboxgl.accessToken,
                                                zoom: 7,
                                                mapboxgl: mapboxgl,
                                                reverseGeocode: true
                                            })
                                        );
                                    </script>
                                </div>
                                <div class="col-12">
                                        <button  style="width: 100%;" type="submit" class="btn roberto-btn mt-15">Añadir local</button>
                                </div>
                            </div>
                                <?php
                                    $establishmentController->create();
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    let div = document.getElementById('map').lastChild.childNodes;
    div[1].lastChild.childNodes[1].name = "location";
    console.log(div[1].lastChild.childNodes[1]);
</script>

<?php 
    else :
        $establishmentController->delete($ruta[1]);
    endif; 
?>
