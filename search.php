<?php
include './php/header.php';
require './dashboard/includes/cn.php';
// Obtener todas las categorías disponibles
$q_categories = "SELECT DISTINCT categorias FROM games";
$result_categories = mysqli_query($conn, $q_categories);

$categories = [];
while ($row_category = mysqli_fetch_assoc($result_categories)) {
    $categories[] = explode(',', $row_category['categorias']);
}
$categories = array_unique(array_merge(...$categories));

$plataformas = [];
while ($row_plataformas = mysqli_fetch_assoc($result_categories)) {
    $plataformas[] = $row_plataformas['plataforma'];
}
$plataformas = array_unique(array_merge(...$plataformas));

// Obtener todos los juegos inicialmente
$q_all_games = "SELECT * FROM games ORDER BY time DESC";
$result_all_games = mysqli_query($conn, $q_all_games);

?>
<script>
$(document).ready(function() {
    // Filtrar juegos al enviar el formulario
    $('#gameFilterForm').on('input', function(e) {
        e.preventDefault();
        filterGames();
    });

    // Filtrar juegos al cambiar la categoría seleccionada
    $('#categoryFilter').on('change', function() {
        filterGames();
    });

    // Función para filtrar los juegos
    function filterGames() {
        var searchValue = $('#searchInput').val().toLowerCase();
        var categoryValue = $('#categoryFilter').val().toLowerCase();

        $('.game-item').each(function() {
            var nombre = $(this).find('img').attr('alt').toLowerCase();
            var categoria = $(this).data('category').toLowerCase();

            // Aplicar filtros de búsqueda y categoría
            if ((searchValue === '' || nombre.indexOf(searchValue) !== -1) &&
                (categoryValue === '' || categoria === categoryValue)) {
                $(this).show(); // Mostrar el juego si coincide con los filtros
            } else {
                $(this).hide(); // Ocultar el juego si no coincide con los filtros
            }
        });
    }
});
</script>
<style>
.image-container-detail {
    position: relative;
    width: 100%;
    height: 230px;
    overflow: hidden;
    /* Ajusta el radio para dar forma a la imagen */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra para la imagen */
}

.image-container-detail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<section class="container-fluid search-section" style="padding-top: 14vh;" id="advanced-search">
    <div class="container">
        <div class="mb-4">
            <h4 class="text-white">Búsqueda</h4>
        </div>
        <form id="gameFilterForm">
            <div class="row gy-4">
                <div class="col-12">
                    <input type="text" class="form-control search-input" id="searchInput"
                        placeholder="Buscar por nombre...">
                </div>
                <div class="col-6 col-md-4">
                    <select class="form-select filter-category" id="categoryFilter">
                        <option value="">Categoría</option>
                        <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-6 col-md-4">
                    <select class="form-select filter-category" id="categoryFilter">
                        <option value="">Consola</option>
                        <?php foreach ($plataformas as $plataforma) { ?>
                        <option value="<?php echo $plataforma; ?>"><?php echo $plataforma; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary"><i class='bx bx-filter-alt'></i> Filtrar</button>
                </div>
            </div>
        </form>

        <div class="row gy-5 px-2 pb-3 mt-2 pt-0" style="overflow:hidden" id="gameList">
            <?php foreach ($result_all_games as $row) { ?>
            <div class="col-6 col-md-2 game-item" data-category="<?php echo $row['categorias']; ?>">
                <div class="image-container-detail">
                    <a href="./detalle?d=<?php echo base64_encode($row['id']); ?>">
                        <img src="./dashboard/components/content/uploads/<?php echo $row['id'].'/'.$row['portada']; ?>"
                            alt="<?php echo $row['nombre']; ?>">
                        <?php if ($row['type'] === 'online') { ?>
                       
                        <?php } ?>
                    </a>
                </div>
                <span class="boxicon bx bx-link-external"
                style="position: absolute; top: 5px; right: 5px; font-size: 24px; color: red;"></span>
                <p class="text-white pt-2"><?php echo $row['nombre'] ?></p>
                <p class="text-white pt-2"><?php echo $row['type'] ?></p>
            </div>
            <?php } ?>
        </div>

    </div>
</section>
<?php
include './php/footer.php';
?>