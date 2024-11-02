<?php include'./components/header.php';?>
<?php 
// detectores

if (isset($_SESSION['key'])){
    $cg = $_SESSION["key"]["cargo"];
    if($cg !== "Administrador") {
        header("Location: index");
    }
}
?>
<?php
// controladores
if (isset($_POST['create'])) {
    $nombre = $_POST['nombre']; 
    $contraseña = $_POST['contraseña'];
    $cargo = $_POST['cargo']; 
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $contactable = $_POST['contactable'];
    $query = "INSERT INTO usuarios(nombre, contraseña, cargo, usuario, estado, telefono, contactable) VALUES ('$nombre', '$contraseña', '$cargo','$usuario', 'activo', '$telefono', '$contactable')";
    mysqli_query($conn, $query);
};

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $query = "DELETE FROM usuarios WHERE id=$id";
    mysqli_query($conn, $query);

};

if (isset($_POST['edit'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre']; 
    $contraseña = $_POST['contraseña'];
    $cargo = $_POST['cargo']; 
    $usuario = $_POST['usuario'];
    $estado = $_POST['estado'];
    $telefono = $_POST['telefono'];
    $contactable = $_POST['contactable'];
    $query = "UPDATE usuarios SET nombre = '$nombre', contraseña = '$contraseña', cargo = '$cargo', usuario = '$usuario', estado = '$estado', telefono = '$telefono', contactable='$contactable' where id='$id'";
    mysqli_query($conn, $query);
};

?>

<script>
$(document).ready(function() {
    $("#buscar").on("input", function() {
        var valorFiltro = $(this).val().toLowerCase();

        $("#tabla_usuarios tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(valorFiltro) > -1);
        });
    });

    $("#buscar_logs").on("input", function() {
        var valorFiltro = $(this).val().toLowerCase();

        $("#tabla_logs tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(valorFiltro) > -1);
        });
    });
    $('#btn-add,#btn-edit').on("click", function() {
        $('#formw').show();
        $('.content').hide();
    })
    $('.atras').on('click', function() {
        window.location.href = './usuarios';
    });


    <?php 
if (isset($_GET['id'])) {
    echo " $('#formw').show();";
    echo "$('.content').hide();";
}
?>

});
</script>

<div class="home-content">
    <div class="flex flex-row">
        <div class="basis-11/12 md:basis-3/12 mb-4  mx-auto hidden" id="formw">
            <div class='px-2  rounded-lg'>
                <div class="bg-white px-3 py-3">
                    <?php 
                if (isset($_GET['id'])) {
                    $idd = $_GET['id'];
                    $query = "SELECT * FROM usuarios where id=$idd";
                    $buscarid = mysqli_query($conn, $query);
                    $br = mysqli_fetch_array($buscarid);
                    
            ?>
                    <p class="atras"><i class='bx bx-chevron-left'></i>Atras</p>
                    <div class="title text-lg font-semibold text-gray-900 mb-2 text-center">Edicion de usuarios</div>
                    <form class="p-5 pt-0" method="POST">
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Nombre completo</span>
                            <input name="nombre" value="<?php echo $br['nombre'] ?>"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Usuario</span>
                            <input name="usuario" value="<?php echo $br['usuario'] ?>"
                                class="border-slate-200 bg-slate-200 p-2 w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Contraseña</span>
                            <input name="contraseña" value="<?php echo $br['contraseña'] ?>" type="password"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Telefono</span>
                            <input name="telefono" value="<?php echo $br['telefono'] ?>"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Contactable</span>
                            <select name="contactable"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                <option value="<?php echo $br['contactable'] ?>" selected hidden>
                                    <?php echo $br['contactable'] ?></option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Cargo</span>
                            <select name="cargo"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                <option value="<?php echo $br['cargo'] ?>" selected hidden><?php echo $br['cargo'] ?>
                                </option>
                                <?php
                        $query = "SELECT * FROM roles";
                        $result_task = mysqli_query($conn, $query);
                        
                        while ($row = mysqli_fetch_array($result_task)) { ?>
                                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Estado</span>
                            <select name="estado"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                <option value="<?php echo $br['estado'] ?>" selected hidden><?php echo $br['estado'] ?>
                                </option>
                                <option value="bloqueado">bloqueado</option>
                                <option value="activo">activo</option>
                            </select>
                        </label>
                        <button action="submit" name="edit" class="rounded w-96 p-3 mt-2 text-white mt-4"
                            style="background-color: #0A2558">Editar</button>
                    </form>
                    <?php } else{ ?>
                    <p class="atras"><i class='bx bx-chevron-left'></i>Atras</p>
                    <div class="font-semi-bold text-lg mb-4 mt-2 text-center title text-lg font-semibold text-gray-900">
                        Crecion
                        de usuarios</div>
                    <form class="p-5 pt-0" method="POST">
                        <label class="block mb-2">
                            <span class="block text-md font-medium text-slate-700">Nombre completo</span>
                            <input name="nombre"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Usuario</span>
                            <input name="usuario"
                                class="border-slate-200 bg-slate-200 p-2 w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />

                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Contraseña</span>
                            <input name="contraseña" type="password"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />
                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Telefono</span>
                            <input name="telefono"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500" />
                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Contactable</span>
                            <select name="contactable"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </label>
                        <label class="block mb-2 mt-4">
                            <span class="block text-md font-medium text-slate-700">Cargo</span>
                            <select name="cargo"
                                class="border-slate-200 bg-slate-200 p-2  w-96 rounded placeholder-slate-400 contrast-more:border-slate-400 contrast-more:placeholder-slate-500">
                                <?php
                        $query = "SELECT * FROM roles";
                        $result_task = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result_task)) { ?>
                                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <button action="submit" name="create" class="rounded w-96 p-3 mt-2 text-white mt-4"
                            style="background-color: #0A2558">Añadir</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class='content basis-11/12 px-4 py-2 md:mx-4'>
        <div class="bg-white p-4 mx-5">
            <div class="grid md:grid-cols-12 md:gap-6 py-3 mb-2">
                <div class="relative col-span-11">
                    <div class="absolute inset-y-0 md:pb-6 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 mt-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="buscar"
                        class="p-3 pl-10 block py-2.5 bg-gray-200 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder="Buscar por Tercero" required>
                </div>
                <div class="col-span-1 text-center">
                    <button type="buttom" id="btn-add"
                        class="px-3 py-2 bg-blue-900 hover:bg-blue-700 text-white text-lg border-gray-300 rounded">
                        <i class='bx bxs-cube-alt'></i>
                    </button>
                </div>

            </div>
            <div class="relative overflow-x-auto ">
                <table class="w-full text-sm text-left text-gray-500" id="tabla_usuarios">
                    <tbody>
                        <?php 
                                 $query = "SELECT * FROM usuarios order by usuario asc";
                                 $result_task = mysqli_query($conn, $query);
                                 $i = 1;
                                 
                                 while ($row = mysqli_fetch_array($result_task)) { 
                                ?>
                        <tr class="border-b text-slate-900  hover:bg-gray-200">

                            <td class="px-0 py-3 ">
                                <div class="avatar online">
                                    <div class="w-8 rounded-full">
                                        <img src="https://automarcol.com/image/plantilla.jpg" />
                                    </div>
                                </div>
                            </td>
                            <td class="px-0 py-3 ">
                                <p> <?php echo strtoupper($row['nombre']); ?></p>
                            </td>
                            <td class="px-2 py-3   ">
                                <?php echo strtoupper($row['usuario']); ?>
                            </td>
                            <td class="px-2 py-3   ">
                                <?php echo $row['cargo']; ?>
                            </td>
                            <td class="px-2 py-3   ">
                                <?php echo $row['telefono']; ?>
                            </td>
                            <td class="px-2 py-3   text-center ">
                                <?php 
                                       if ($row['estado'] == 'activo') {
                                           echo '<div class="badge badge-success gap-2 text-white">
                                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                           Activo
                                         </div>';
                                        }else{
                                            echo '<div class="badge bg-red-600 gap-2 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Bloqueado
                                          </div>';
                                        }
                                        ?>
                            </td>
                            <td class="px-2 py-3 text-center ">
                                <?php 
                                       if ($row['contactable'] == 'Si') {
                                        echo '<div class="badge badge-success gap-2 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Contactable
                                      </div>';
                                        }else{
                                            echo '<div class="badge bg-red-600 gap-2 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            No contactado
                                          </div>';
                                        }
                                        ?>
                            </td>
                            <td class="px-2 py-3  text-md text-center">
                                <a href="?id=<?php echo $row['id'] ?>"><i
                                        class='bx bx-edit p-2 bg-slate-900 text-white rounded text-center'></i></a>
                                <a href="?del=<?php echo $row['id'] ?>"><i
                                        class='bx bx-trash p-2 bg-slate-900 text-white rounded text-center'></i></a>
                            </td>
                        </tr>

                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<?php include'./components/footer.php';?>