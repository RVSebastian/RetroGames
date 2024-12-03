<?php include './components/header.php';?>

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function() {
    $('#add-content, #back').click(function() {
        $('#1,#2').toggleClass('hidden');
    });
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

<div class="home-content" id="1">
    <div id="logs" class="content basis-11/12 px-4 pb-8 md:mx-2">
        <div class="lg:px-4 sm:px-2 pt-2 ">
            <div class='basis-11/12 md:px-3 w-full px-2 mb-7'>
                <div class="flex justify-between items-center">
                    <div class="relative w-full pr-4">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="buscar_logs"
                            class="w-full bg-white shadow-md rounded-md placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-10 pr-3 py-4 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow peer"
                            placeholder="Buscar contenido">
                    </div>
                    <button type="button" id="add-content" class="bg-blue-500 py-2 px-3 rounded-full text-white"><i
                            class='bx bx-add-to-queue'></i></button>
                </div>
            </div>

            <div class='basis-11/12 md:px-3 w-full px-2'>
                <div class="relative overflow-x-auto pb-5">
                    <table class="w-full text-sm text-left text-gray-500 table-auto" id="tabla_logs">
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM games ORDER BY time DESC";
                                $result_task = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result_task)) { 
                            ?>
                            <tr
                                class="border-b border-gray-150 text-gray-900 hover:bg-gray-50 bg-white shadow-md rounded-md">
                                <td class="p-2 text-center">
                                    <img src="./components/content/uploads/<?php echo $row['id'].'/'.$row['portada']; ?>"
                                        onerror="this.onerror=null; this.src='https://static.as.com/dist/resources/images/meristation/placeholder-cover.png';"
                                        class="w-16 h-20 object-fill rounded-lg" alt="Carátula">
                                </td>
                                <td class="p-2 font-semibold">
                                    <?php echo $row['nombre']; ?>
                                </td>
                                <td class="p-2">
                                    <?php echo $row['plataforma']; ?>
                                </td>
                                <td class="p-2">
                                    <?php echo $row['type']; ?>
                                </td>
                                <td class="p-2">
                                    <?php echo $row['categorias']; ?>
                                </td>

                                <td class="p-2">
                                    <?php echo $row['time']; ?>
                                </td>
                                <td class="p-2">
                                    <i class='bx bx-group text-lg text-blue-600'></i> <?php echo $row['views']; ?>
                                </td>
                                <td class="p-2">
                                    <i class='bx bx-cloud-download text-lg text-slate-600'></i>
                                    <?php echo $row['dowloads']; ?>
                                </td>

                                <td class="p-2">
                                    <a href="./edit-content?v=<?php echo $row['id']; ?>" class="p-2 text-lg">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-content hidden md:mx-5" id="2">
    <form id="gameForm">
        <div class="content basis-11/12 px-4 md:mx-5 pb-6">
            <div class="w-full  px-4 py-2 mx-auto bg-white shadow-md rounded-md lg:py-3 mb-4">
                <div class="container items-center mx-auto text-slate-800">
                    <a href="./index"
                        class="mr-4 block cursor-pointer py-1.5 text-base text-slate-800  pb-2 text-sm text-gray-900 hover:cursor-pointer"
                        id="back"><i class='bx bx-chevron-left'></i> Regresar</a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 ">
                <div class="bg-white shadow-md rounded-md md:col-span-6 lg:col-span-2 p-5">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Titulo</label>
                            <input type="text" id="titulo" name="titulo"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                placeholder="John" />
                        </div>
                        <div>
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Peso</label>
                            <input type="text" id="descripcion" name="descripcion"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                placeholder="1MB" />
                        </div>
                        <div>
                            <label for="version" class="block mb-2 text-sm font-medium text-gray-900">Version</label>
                            <input type="text" id="version" name="version"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                placeholder="1.0" />
                        </div>
                        <div>
                            <label for="formato" class="block mb-2 text-sm font-medium text-gray-900">Formato</label>
                            <input type="text" id="formato" name="formato"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                placeholder="NSP" />
                        </div>
                        <div class="">
                            <label for="categories"
                                class="block mb-2 text-sm font-medium text-gray-900">Plataforma</label>
                            <div class="relative">
                                <select
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow text-left"
                                    name="plataforma" id="plataforma">
                                    <option value="Switch">Nintendo Switch</option>
                                    <option value="WIIU">WII U</option>
                                    <option value="N3DS">Nintendo 3DS</option>
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
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow text-left">
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
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-action" type="checkbox" value="accion"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-action"
                                                class="ml-2 text-sm font-medium text-gray-900">Acción</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-action" type="checkbox" value="simulacion"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-action"
                                                class="ml-2 text-sm font-medium text-gray-900">Simulacion</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-action" type="checkbox" value="android"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-action"
                                                class="ml-2 text-sm font-medium text-gray-900">Android</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-adventure" type="checkbox" value="aventura"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-adventure"
                                                class="ml-2 text-sm font-medium text-gray-900">Aventura</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-sports" type="checkbox" value="deportes"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-sports"
                                                class="ml-2 text-sm font-medium text-gray-900">Deportes</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-strategy" type="checkbox" value="estrategia"
                                                name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-strategy"
                                                class="ml-2 text-sm font-medium text-gray-900">Estrategia</label>
                                        </li>
                                        <li class="flex items-center p-2 hover:bg-gray-100 rounded">
                                            <input id="category-rpg" type="checkbox" value="rpg" name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="category-rpg"
                                                class="ml-2 text-sm font-medium text-gray-900">RPG</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="pb-2">Contenido adicional</p>
                    <textarea
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        name="contenido" id="contenido" style="width: 100%; height: 300px;"></textarea>

                    <label class="block mt-2 mb-2 text-sm font-medium text-gray-900" for="file_input">URL
                        Website</label>
                    <input placeholder="www.prueba.com/rom.rar"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        aria-describedby="file_input_help" id="rom" name="rom" type="text">

                    <div class="py-3">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Plataforma</label>
                        <div class="relative">
                            <select
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow text-left"
                                name="type" id="type">
                                <option value="ROM">ROM</option>
                                <option value="Online">ONLINE</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="saveButton"
                        class="mt-2 px-2.5 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">Guardar</button>

                </div>
                <div class='bg-white shadow-md rounded-md md:col-span-6 lg:col-span-4  p-5'>
                    <div class="px-3 pt-2 pb-5">
                        <p class="">Caratula o Portada</p>
                        <p class="text-gray-600 text-sm mb-4"><i class='bx bx-bell'></i> Apartado de las imagenes que se
                            mostrara en la caratura de las tarjetas ( los tamaños no son exactos, es para ver
                            graficamente como se pintarian)</p>

                        <div class="grid grid-cols-2 md:grid-cols-3 gx-3">
                            <div class="p-2">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 200px; height: 200px" alt="" id="img-200">
                                <p>200x200</p>

                            </div>
                            <div class="p-2">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 180px; height: 150px" alt="" id="img-150">
                                <p>150x150</p>
                            </div>
                            <div class="p-2">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 100px; height: 100px" alt="" id="img-100">
                                <p>100x100</p>
                            </div>
                        </div>
                        <input
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            aria-describedby="file_input_help" id="portada" type="file" name="portada">

                        <p class="pt-8">Captures</p>
                        <p class="text-gray-600 text-sm mb-4"><i class='bx bx-bell'></i> Apartado de las imagenes que se
                            mostraran en el detalle en la seccion de capture o review</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4  pb-8">
                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-1">
                                <input
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    aria-describedby="file_input_help" id="capture_input_1" type="file"
                                    name="capture_1">

                            </div>
                            <div class="p-2">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-2">
                                <input
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    aria-describedby="file_input_help" id="capture_input_2" type="file"
                                    name="capture_2">

                            </div>
                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-3">
                                <input
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    aria-describedby="file_input_help" id="capture_input_3" type="file"
                                    name="capture_3">

                            </div>

                            <div class="p-2" style="width: 250px; height: 180px">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOwRConBYl2t6L8QMOAQqa5FDmPB_bg7EnGA&s"
                                    style="width: 250px; height: 180px" class="mb-4" alt="" id="capture-4">
                                <input
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
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
        var requiredFields = ['#titulo', '#portada', '#rom', '#type'];

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
        }

        var formData = new FormData(this);
        formData.append('mod', 'add'); // Agrega la variable mod=edit al FormData
        $.ajax({
            url: './components/content/res.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'Registro creado y actualizado correctamente.') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Formulario enviado correctamente.'
                    });
                    location.assign('./index');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al enviar el formulario: ' + response
                    });
                }
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