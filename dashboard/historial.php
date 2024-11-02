<?php include'./components/header.php';?>

<script>
$(document).ready(function() {

    $("#buscar_logs").on("change", function() {
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


});
</script>

<div class="home-content">
    <div id="logs" class="content basis-11/12  px-4 md:mx-4">
        <div class="bg-white rounded p-4 mx-5">
            <div class='basis-11/12'>
                <div class="">
                    <div class="grid md:grid-cols-1 md:gap-6 py-3 mb-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 md:pb-6 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 mt-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="buscar_logs"
                                class="p-4 pl-10 block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder="Buscar Logs" required>

                        </div>


                    </div>
                    <div class="relative overflow-x-auto ">
                        <table class="w-full text-sm text-left text-gray-500" id="tabla_logs">

                            <tbody>
                                <?php 
                                $query = "SELECT * FROM logs 
                                WHERE usuario != 'VARGAZS' 
                                  AND usuario != ' ' 
                                  AND time >= NOW() - INTERVAL 80 DAY 
                                ORDER BY time DESC";
                      
                                 $result_task = mysqli_query($conn, $query);
                                 while ($row = mysqli_fetch_array($result_task)) { 
                                ?>
                                <tr class="border-b text-slate-900  hover:bg-gray-100 text-stard">
                                    <td class="p-1  text-center ">

                                        <?php if($row['ext'] == '190.85.51.38'){
                                            echo "<i class='bx bx-check-shield p-2 bg-green-600 text-white rounded text-center' ></i>";
                                        }else{
                                            echo "<i class='bx bx-shield-x p-2 bg-red-600 text-white rounded text-center' ></i>";
                                        }; ?>
                                    </td>
                                    <td class="p-1 text-center ">
                                        <?php 
                                       if (strpos($row['htp'], 'Mobile') !== false) {
                                           echo "<i class='bx bx-mobile-alt p-2 bg-indigo-500 text-white rounded' ></i>";
                                        }else{
                                           echo "<i class='bx bx-laptop p-2 bg-slate-700 text-white rounded' ></i>";
                                        }
                                        ?>
                                    </td>
                          
                                    <td class="py-2 px-4">
                                        <?php echo strtoupper($row['usuario']); ?>
                                    </td>

                                    <td class="p-2">
                                        <?php echo $row['actions']; ?>
                                    </td>
                                    
                                    <td class="p-2">
                                        <?php echo substr($row['htp'], 0, 80); ?>
                                    </td>
                                    <td class="p-2">
                                        <?php echo $row['time']; ?>
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
</div>


<?php include'./components/footer.php';?>