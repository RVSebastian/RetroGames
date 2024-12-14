<?php
include './php/header.php';

require './dashboard/includes/cn.php';

$q = "SELECT * FROM games WHERE type='ROM' ORDER BY time DESC";
$result = mysqli_query($conn,$q);
$relevant = [];
$most_view = [];
$new_content = [];
$games_by_category = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $relevant[] = $row;
        $most_view[] = $row;
        $new_content[] = $row;
        $categories = explode(',', $row['plataforma']);
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
?>


<section class="container" style="padding-bottom: 20vh;padding-top: 10vh;" id="examples">
    <div class="p-2">
        <div class="container pt-2">
            <?php foreach ($games_by_category as $category => $games): ?>
            <h3 class="titulo-card text-white pt-3"><?php echo ucfirst($category); ?></h3>
            <div class="row pb-3 mt-0 pt-0" style="overflow:hidden">
                <div class="swiper-container">
                    <div class="swiper-wrapper d-none left">
                        <?php 
                $count = 0;
                foreach ($games as $game) {
                    if ($count >= 50) {
                        break;
                    }
                ?>
                        <div class="swiper-slide">
                            <div class="image-container">
                                <a href="./detalle?game=<?php echo $game['nombre'] ?>&d=<?php echo base64_encode($game['id']) ?>">
                                    <img src="./dashboard/components/content/uploads/<?php echo $game['id'].'/'.$game['portada'] ?>"
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