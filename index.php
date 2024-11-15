<?php
include './php/header.php';

require './dashboard/includes/cn.php';

$q = "SELECT * FROM games WHERE type='ROM' ORDER BY time DESC";
$result = mysqli_query($conn,$q);

?>

<div class="video-container position-relative st shadow" id="home">
    <video autoplay loop muted class="position-absolute top-0 left-0">
        <source src="./img/video.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <section>
        <div class="container pt-md-4 pb-8 position-relative z-index-1">
            <div class="row">
                <div class="col-12 pt-5">
                    <div class="info-text text-light text-center">
                        <h3 class="pb-0 ">ROMS</h3>
                        <h6 class="pb-0 ">¡Descarga y juega!</h6>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>


<section class="container pt-5" style="padding-bottom: 20vh;" id="examples">
    <div class="p-2">
        <div class="container pt-2">
            <h3 class="titulo-card text-white">Relevant</h3>
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="swiper-container-relevant">
                    <div class="swiper-wrapper  d-none right">
                        <?php 
                        $relevant = [];
                        $most_view = [];
                        $new_content = [];
                        $games_by_category = [];

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $relevant[] = $row;
                                $most_view[] = $row;
                                $new_content[] = $row;
                                $categories = explode(',', $row['categorias']);
                                foreach ($categories as $category) {
                                    $category = trim($category); // Eliminar espacios en blanco alrededor de la categoría
                                    $games_by_category[$category][] = $row;
                                }
                            }
                        }
                        foreach ($games_by_category as $category => $games) {
                            usort($games_by_category[$category], function($a, $b) {
                                $timeA = strtotime($a['time']);
                                $timeB = strtotime($b['time']);
                                return $timeB - $timeA; // Orden descendente por time
                            });
                        }
                        usort($relevant, function($a, $b) {
                            return $b['dowloads'] - $a['dowloads'];
                        });
                        $count = 0;
                      
                        foreach ($relevant as $row){ 
                            if ($count >= 15) {
                               break;
                            }
                        ?>
                        <div class="swiper-slide">
                            <div class="image-container-relevant">
                                <a href="./detalle?d=<?php echo base64_encode($row['id']) ?>">
                                    <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                        alt=""
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';">
                                </a>
                            </div>
                            <p class="text-white pt-2"><?php echo $row['nombre'] ?></p>
                        </div>
                        <?php 
                        $count++;
                        } ?>

                    </div>

                </div>
            </div>

            <h3 class="titulo-card text-white pt-3">Most view</h3>
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="swiper-container">
                    <div class="swiper-wrapper d-none down">
                        <?php 
                        usort($most_view, function($a, $b) {
                            return $b['views'] - $a['views'];
                        });
                        $count2 = 0;
                        foreach ($most_view as $row){ 
                            if ($count2 >= 15) {
                               break;
                            }
                        ?>
                        <div class="swiper-slide">
                            <div class="image-container">
                                <a href="./detalle?d=<?php echo base64_encode($row['id']) ?>">
                                    <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                        alt=""
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';">
                                </a>
                            </div>
                            <p class="text-white pt-2"><?php echo $row['nombre'] ?></p>
                        </div>
                        <?php 
                        $count2++;
                        } ?>
                    </div>

                </div>
            </div>
            <h3 class="titulo-card text-white pt-3">New content</h3>
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="swiper-container">
                    <div class="swiper-wrapper d-none left">
                        <?php 
                        usort($new_content, function($a, $b) {
                            $timeA = strtotime($a['time']);
                            $timeB = strtotime($b['time']);
                            return $timeB - $timeA; // Orden descendente por time
                        });
                        $count2 = 0;
                        foreach ($new_content as $row){ 
                            if ($count2 >= 15) {
                               break;
                            }
                        ?>
                        <div class="swiper-slide">
                            <div class="image-container">
                                <a href="./detalle?d=<?php echo base64_encode($row['id']) ?>">
                                    <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                        alt=""
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';">
                                </a>
                            </div>
                            <p class="text-white pt-2"><?php echo $row['nombre'] ?></p>
                        </div>
                        <?php 
                        $count2++;
                        } ?>
                    </div>

                </div>
            </div>

            <?php foreach ($games_by_category as $category => $games): ?>
            <h3 class="titulo-card text-white pt-3"><?php echo ucfirst($category); ?></h3>
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="swiper-container">
                    <div class="swiper-wrapper d-none left">
                        <?php 
                $count = 0;
                foreach ($games as $game) {
                    if ($count >= 15) {
                        break;
                    }
                ?>
                        <div class="swiper-slide">
                            <div class="image-container">
                                <a href="./detalle?d=<?php echo base64_encode($game['id']) ?>">
                                    <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada'] ?>"
                                        alt=""
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';">
                                </a>
                            </div>
                            <p class="text-white pt-2"><?php echo $game['nombre'] ?></p>
                        </div>
                        <?php 
                    $count++;
                } ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>


</section>

<?php
include './php/footer.php';
?>