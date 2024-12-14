<?php
include './php/header.php';

require './dashboard/includes/cn.php';


$id = base64_decode($_GET['d']);
$q = "SELECT * FROM games WHERE id = '$id' ";
$u = "UPDATE games SET views = views + 1 WHERE id = '$id' ";
$result = mysqli_query($conn,$q);

?>
<?php 
foreach ($result as $row){ 
    $type =  $row['type'];
    $q2 = "SELECT * FROM games WHERE type = '$type' ORDER BY RAND() LIMIT 20";
    $result2 = mysqli_query($conn,$q2);
    $result = mysqli_query($conn,$u);
?>
<style>
.fullscreen-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    z-index: 10;
    font-size: 16px;
}

.exit-fullscreen-button {
    display: none;
    position: absolute;
    top: 10px;
    right: 60px;
    background-color: #ff0000;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    z-index: 10;
    font-size: 16px;
}

.iframe-container {
    position: relative;
    width: 100%;
    height: 700px;
}

@media (max-width: 767px) {

    .fullscreen-button,
    .exit-fullscreen-button {
        padding: 15px;
        font-size: 20px;
    }

    .iframe-container {
        height: 350px;
    }
}

@media (orientation: landscape) and (max-width: 767px) {
    .iframe-container {
        height: 100vh;
    }
}
</style>
<section class="container" style="padding-bottom: 20vh; padding-top: 14vh;" id="examples">
    <div class="p-2">
        <div class="container pt-2">
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="col-12 col-lg-2 text-center pb-3">
                    <div class="row">
                        <div class="col-12">
                            <img class="text-center mx-auto img-fluid" style="max-width: 200px;"
                                src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';"
                                alt="">
                        </div>
                        <div class="col-12">
                            <?php
                            if ($row['type'] == 'ROM') {
                            ?>

                            <a dowload target="_blank" href="<?php echo $row['game'] ?>"
                                class="btn btn-success text-white mt-3 boton_descargar" onClick="boton_descargar(<?php echo $row['id'] ?>)"><i
                                    class='bx bx-arrow-to-bottom'></i>
                                Descargar ROM</a>
                            <?php
                             }else{
                                echo '<p class="text-white pt-3" style="font-size: 13px !important;">Este juego es Online, no necesita descargarse para ejecutarse.</p>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-10">
                    <div class="px-md-4">
                        <p class="text-white py-3"><?php echo $row['nombre'] ?></p>
                        <p class="text-white fw-semibold pt-2">Plataforma: </p>
                        <p class="text-white"><?php echo $row['plataforma'] ?></p>
                        <p class="text-white fw-semibold pt-2">Categorias</p>
                        <?php 
                        $categories = explode(',', $row['categorias']);
                        foreach ($categories as $category) {
                            $category = trim($category); 
                            echo '    <p class="text-white">'.$category.'</p>';
                        }
                        ?>

                    </div>
                </div>
                <div>
                    <?php
                            if ($row['type'] == 'Online') {
                            ?>
                    <div class="pt-5">

                        <?php
                    $url = $row['game'];

                    // Verificar si la URL apunta a un archivo
                    if (preg_match('/\.[a-zA-Z0-9]{2,5}$/', $url)) {
                        // Obtener la extensión del archivo
                        $url_parts = parse_url($url);
                        $path_info = pathinfo($url_parts['path']);
                        $extension = isset($path_info['extension']) ? strtolower($path_info['extension']) : '';

                        // Lista de extensiones que deseas permitir
                        $allowed_extensions = ['html', 'htm']; // Agrega aquí las extensiones que deseas permitir

                        // Verificar si la extensión está en la lista de permitidos
                        if (!in_array($extension, $allowed_extensions)) {
                            ?>
                        <div>
                            <p class="text-white "><i class='bx bx-alarm-exclamation'></i> Hubo un error al cargar el
                                documento <?php echo htmlspecialchars($url) ?></p>
                        </div>
                        <?php
                        } else {
                            ?>
                        <div class="iframe-container">
                            <iframe class="" id="gameIframe" width="100%" height="100%" scrolling="none"
                                src="<?php echo htmlspecialchars($url) ?>"></iframe>
                            <button class="fullscreen-button" onclick="toggleFullscreen()">Fullscreen</button>
                            <button class="exit-fullscreen-button" onclick="exitFullscreen()">Exit Fullscreen</button>
                        </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="iframe-container">
                            <iframe class="" id="gameIframe" width="100%" height="100%" scrolling="none"
                                src="<?php echo htmlspecialchars($url) ?>"></iframe>
                            <button class="fullscreen-button" onclick="toggleFullscreen()">Fullscreen</button>
                            <button class="exit-fullscreen-button" onclick="exitFullscreen()">Exit Fullscreen</button>
                        </div>
                        <?php
                    }
                    ?>



                    </div>
                    <script>
                    function toggleFullscreen() {
                        var iframe = document.getElementById('gameIframe');
                        if (iframe.requestFullscreen) {
                            iframe.requestFullscreen();
                        } else if (iframe.mozRequestFullScreen) { // Firefox
                            iframe.mozRequestFullScreen();
                        } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
                            iframe.webkitRequestFullscreen();
                        } else if (iframe.msRequestFullscreen) { // IE/Edge
                            iframe.msRequestFullscreen();
                        }
                        document.querySelector('.fullscreen-button').style.display = 'none';
                        document.querySelector('.exit-fullscreen-button').style.display = 'block';
                    }

                    function exitFullscreen() {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        } else if (document.mozCancelFullScreen) { // Firefox
                            document.mozCancelFullScreen();
                        } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
                            document.webkitExitFullscreen();
                        } else if (document.msExitFullscreen) { // IE/Edge
                            document.msExitFullscreen();
                        }
                        document.querySelector('.fullscreen-button').style.display = 'block';
                        document.querySelector('.exit-fullscreen-button').style.display = 'none';
                    }

                    document.addEventListener('fullscreenchange', exitHandler);
                    document.addEventListener('webkitfullscreenchange', exitHandler);
                    document.addEventListener('mozfullscreenchange', exitHandler);
                    document.addEventListener('MSFullscreenChange', exitHandler);

                    function exitHandler() {
                        if (!document.fullscreenElement && !document.webkitFullscreenElement && !document
                            .mozFullScreenElement && !document.msFullscreenElement) {
                            document.querySelector('.fullscreen-button').style.display = 'block';
                            document.querySelector('.exit-fullscreen-button').style.display = 'none';
                        }
                    }

                    window.addEventListener('orientationchange', function() {
                        if (window.orientation === 90 || window.orientation === -90) {
                            // Landscape
                            document.querySelector('.iframe-container').style.height = '100vh';
                        } else {
                            // Portrait
                            document.querySelector('.iframe-container').style.height = '350px';
                        }
                    });
                    </script>
                    <?php
                            }
                            ?>
                </div>

                <?php
                if (!empty($row['img1'])) {
                    echo '<h3 class="titulo-card text-white pt-5 pb-4">Captures</h3>';
                }
                ?>
                <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                    <div class="swiper-container3">
                        <div class="swiper-wrapper d-none text-white">
                            <?php 
                            for ($i = 1; $i <= 6; $i++) { 
                                if (!empty($row['img'.$i])) { // Verificar si el campo img$i no está vacío
                                    $target = $row['id'].'/'.$row['img'.$i];
                                    $imagePath = "./dashboard/components/content/uploads/".$target;
                                    
                                    // Verificar si el archivo existe en la ubicación especificada
                                    if (file_exists($imagePath)) {
                            ?>
                            <div class="swiper-slide">
                                <div class="image-container-detail">
                                    <img src="<?php echo $imagePath; ?>"
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';"
                                        alt="">
                                </div>
                            </div>
                            <?php 
                                    } // Cierre de if (file_exists($imagePath))
                                } // Cierre de if (!empty($row['img'.$i]))
                            } // Cierre de for
                            ?>
                        </div>
                    </div>
                </div>





                <div class="py-5">
                    <h3 class="titulo-card text-white pt-3">Recomendados</h3>
                    <div class="row pb-3 mt-0 pt-3" style="overflow:hidden">
                        <div class="swiper-container-detail">
                            <div class="swiper-wrapper d-none">
                                <?php 
                        
                        foreach ($result2 as $row){ 
                          
                        ?>
                                <div class="swiper-slide">
                                    <div class="image-container-detail">
                                        <a href="./detalle?game=<?php echo $row['nombre'] ?>&d=<?php echo base64_encode($row['id']) ?>">
                                            <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                                onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';"
                                                alt="">

                                        </a>
                                    </div>
                                    <p class="text-white"><?php echo $row['nombre'] ?></p>
                                </div>
                                <?php 
                      
                        } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var swiper3 = new Swiper('.swiper-container3', {
    slidesPerView: 1.2,
    spaceBetween: 15,
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});
var swiper4 = new Swiper('.swiper-container-detail', {
    slidesPerView: 2,
    spaceBetween: 15,
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 6,
        },
    },
});

function boton_descargar(id) {
    $.ajax({
        type: "POST",
        url: "./php/dw.php",
        data: {
            id
        },
        success: function(response) {
            console.log(response);
                if (response === 'Se guardó correctamente.') {
                    console.log('ok');
                    
                }
        }
    });
}
</script>
<?php 
} ?>
<?php
include './php/footer.php';
?>