<?php 

include './components/header.php';
$ud = $_GET['v'];
$query = "SELECT * FROM games WHERE id = '$ud'";
$result_task = mysqli_query($conn, $query);

?>

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function() {
    $('#buscar_logs').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();

        $('#tabla_logs tbody tr').each(function() {
            var lineStr = $(this).text().toLowerCase();
            var isVisible = lineStr.indexOf(searchText) !== -1;
            $(this).toggle(isVisible);
        });
    });

});
</script>

<?php
foreach ($result_task as $row) {
    $categorias_seleccionadas = explode(",", $row['categorias']);

// Lista de categorías posibles y sus valores
$categorias_posibles = [
    "accion" => "Acción",
    "aventura" => "Aventura",
    "deportes" => "Deportes",
    "estrategia" => "Estrategia",
    "rpg" => "RPG"
];

// Función para verificar si una categoría está seleccionada
function estaSeleccionada($categoria, $categorias_seleccionadas) {
    return in_array($categoria, $categorias_seleccionadas);
}
?>
<div class="home-content" id="2">
    <form id="gameForm">
        <input type="hidden" name="id_juego" id="id_juego" value="<?php echo $ud; ?>">
        <div class="content basis-11/12 px-4 md:mx-5 pb-6">
            <a href="./index" class="pt-1 pb-4 text-sm text-gray-900 hover:cursor-pointer" id="back"><i
                    class='bx bx-chevron-left'></i> Regresar</a>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 ">
                <div class="bg-white md:col-span-6 lg:col-span-2 p-5">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Titulo</label>
                            <input type="text" id="titulo" name="titulo" value="<?php echo $row['nombre'] ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900">Descripcion</label>
                            <input type="text" id="descripcion" name="descripcion"
                                value="<?php echo $row['descripcion'] ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Doe" />
                        </div>
                        <div class="">
                            <label for="categories"
                                class="block mb-2 text-sm font-medium text-gray-900">Plataforma</label>
                            <div class="relative">
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 text-left"
                                    name="plataforma" id="plataforma">
                                    <option selected value="<?php echo $row['plataforma'] ?>">
                                        <?php echo $row['plataforma'] ?></option>
                                    <option value="N64">Nintendo 64 (N64)</option>
                                    <option value="PS4">PlayStation 4 (PS4)</option>
                                    <option value="PC">PC (Windows, macOS, Linux)</option>
                                    <option value="SNES">Super Nintendo Entertainment System (SNES)</option>
                                    <option value="Genesis">Sega Genesis</option>
                                    <option value="GBA">Game Boy Advance (GBA)</option>
                                    <option value="NES">Nintendo Entertainment System (NES)</option>
                                    <option value="PSP">PlayStation Portable (PSP)</option>
                                    <option value="DS">Nintendo DS (DS)</option>
                                    <option value="Wii">Nintendo Wii</option>
                                    <option value="Xbox">Xbox (Original)</option>
                                    <option value="Dreamcast">Sega Dreamcast</option>
                                    <option value="GameCube">Nintendo GameCube</option>
                                    <option value="PS2">PlayStation 2 (PS2)</option>
                                    <option value="Xbox360">Xbox 360</option>
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <label for="categories"
                                class="block mb-2 text-sm font-medium text-gray-900">Categorías</label>
                            <div class="relative">
                                <button id="dropdownButton2" type="button"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 text-left">
                                    Seleccionar categorías
                                    <svg class="w-4 h-4 ml-2 float-right" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </button>
                                <div id="dropdownMenu2"
                                    class="absolute bg-white border border-gray-300 rounded-lg shadow-md w-full mt-2 hidden z-10">
                                    <ul class="p-3 space-y-2 text-sm text-gray-700">
                                        <?php foreach ($categorias_posibles as $valor => $label): ?>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-<?php echo $valor; ?>" type="checkbox"
                                                value="<?php echo $valor; ?>" name="categories[]"
                                                <?php echo estaSeleccionada($valor, $categorias_seleccionadas) ? 'checked' : ''; ?>
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-<?php echo $valor; ?>"
                                                class="ml-2 text-sm font-medium text-gray-900"><?php echo $label; ?></label>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="pb-2">Contenido adicional</p>
                    <textarea
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="contenido" id="contenido" style="width: 100%; height: 300px;"></textarea>

                    <label class="block mt-2 mb-2 text-sm font-medium text-gray-900" for="file_input">URL
                        Website</label>
                    <input placeholder="www.prueba.com/rom.rar" value="<?php echo $row['game'] ?>"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="rom" name="rom" type="text">

                    <div class="py-3">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Plataforma</label>
                        <div class="relative">
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 text-left"
                                name="type" id="type">
                                <option selected value="<?php echo $row['type'] ?>"><?php echo $row['type'] ?></option>
                                <option value="ROM">ROM</option>
                                <option value="Online">ONLINE</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="saveButton"
                        class="mt-2 px-2.5 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">Guardar</button>

                </div>
                <div class='bg-white md:col-span-6 lg:col-span-4  p-5'>
                    <div class="px-3 pt-2 pb-5">
                        <p class="">Caratula o Portada</p>
                        <p class="text-gray-600 text-sm mb-4"><i class='bx bx-bell'></i> Apartado de las imagenes que se
                            mostrara en la caratura de las tarjetas ( los tamaños no son exactos, es para ver
                            graficamente como se pintarian)</p>

                        <div class="grid grid-cols-2 md:grid-cols-3 gx-3">
                            <div class="p-2">
                                <img src="
                                <?php if (!empty($row['portada'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['portada'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>
                                " style="width: 200px; height: 200px" alt="" id="img-200">
                                <p>200x200</p>

                            </div>
                            <div class="p-2">
                                <img src="<?php if (!empty($row['portada'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['portada'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>" style="width: 180px; height: 150px" alt="" id="img-150">
                                <p>150x150</p>
                            </div>
                            <div class="p-2">
                                <img src="<?php if (!empty($row['portada'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['portada'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>" style="width: 100px; height: 100px" alt="" id="img-100">
                                <p>100x100</p>
                            </div>
                        </div>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="portada" type="file" name="portada">

                        <p class="pt-8">Captures</p>
                        <p class="text-gray-600 text-sm mb-4"><i class='bx bx-bell'></i> Apartado de las imagenes que se
                            mostraran en el detalle en la seccion de capture o review</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4  pb-8">
                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="
                                <?php if (!empty($row['img1'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['img1'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>
                                " style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-1">
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="capture_input_1" type="file"
                                    name="capture_1">

                            </div>
                            <div class="p-2">
                                <img src="
                                <?php if (!empty($row['img2'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['img2'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>
                                " style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-2">
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="capture_input_2" type="file"
                                    name="capture_2">

                            </div>
                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="   <?php if (!empty($row['img3'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['img3'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>" style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-3">
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="capture_input_3" type="file"
                                    name="capture_3">

                            </div>

                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="   <?php if (!empty($row['img4'])) {
                                    echo './components/content/uploads/'.$row['id'].'/'.$row['img4'];
                                }else{
                                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s";
                                }
                                ?>" style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-4">
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="capture_input_4" type="file"
                                    name="capture_4">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<?php
}
?>

<script>
$(document).ready(function() {
    // Mostrar/ocultar el menú desplegable
    $('#dropdownButton').click(function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Mostrar/ocultar el segundo menú desplegable
    $('#dropdownButton2').click(function() {
        $('#dropdownMenu2').toggleClass('hidden');
    });

    // Cambiar el color de fondo al seleccionar una categoría
    $('#dropdownMenu input[type="checkbox"]').change(function() {
        $(this).parent().toggleClass('bg-blue-100', this.checked);
    });

    $('#dropdownMenu2 input[type="checkbox"]').change(function() {
        $(this).parent().toggleClass('bg-blue-100', this.checked);
    });

    // Cerrar el menú desplegable si el usuario hace clic fuera de él
    $(document).click(function(event) {
        if (!$(event.target).closest('#dropdownButton, #dropdownMenu').length) {
            $('#dropdownMenu').addClass('hidden');
        }
        if (!$(event.target).closest('#dropdownButton2, #dropdownMenu2').length) {
            $('#dropdownMenu2').addClass('hidden');
        }
    });

    // Actualizar vistas previas de las imágenes
    function updateImagePreviews(input, imageElements) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imageElements.forEach(img => img.attr('src', e.target.result));
            };
            reader.readAsDataURL(file);
        }
    }

    const portadaInput = $('#portada');
    const captureInputs = [
        $('#capture_input_1'),
        $('#capture_input_2'),
        $('#capture_input_3'),
        $('#capture_input_4')
    ];

    const img200 = $('#img-200');
    const img150 = $('#img-150');
    const img100 = $('#img-100');
    const captureImages = [
        $('#capture-1'),
        $('#capture-2'),
        $('#capture-3'),
        $('#capture-4')
    ];

    portadaInput.change(function() {
        updateImagePreviews(this, [img200, img150, img100]);
    });

    captureInputs.forEach((input, index) => {
        input.change(function() {
            updateImagePreviews(this, [captureImages[index]]);
        });
    });

    function validateForm() {
        var isValid = true;
        var requiredFields = ['#titulo'];

        requiredFields.forEach(function(field) {
            if ($(field).val() === '' || $(field).val() === null) {
                isValid = false;
            }
        });

        if ($('input[name="categories[]"]:checked').length === 0) {
            isValid = false;
        }

        return isValid;
    }

    $('#gameForm').submit(function(e) {
        e.preventDefault();

        if (!validateForm()) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, completa todos los campos requeridos.'
            });
            return;
        }zapatos blancos hombrez

        var formData = new FormData(this);
        formData.append('mod', 'edit'); // Agrega la variable mod=edit al FormData
        $.ajax({
            url: './components/content/res.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Formulario enviado correctamente.'
                });
                console.log('Formulario enviado correctamente');
                console.log(response);
                location.assign('./index');
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el formulario: ' + textStatus
                });
                console.log('Error al enviar el formulario: ' + textStatus, errorThrown);
            }
        });
    });

});
</script>


<?php include './components/footer.php';?>