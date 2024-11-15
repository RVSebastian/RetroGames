<?php
// Asumiendo que el ID viene por GET, ajusta según tu necesidad.

if (isset($_POST['id'])) {
    require '../dashboard/includes/cn.php';
    $id = $_POST['id'];  
    // Utilizamos prepared statements para evitar inyecciones SQL
    $q = "UPDATE games SET dowloads = dowloads + 1 WHERE id = ?";
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("i", $id);  // 'i' es para un parámetro entero (ID)
        if ($stmt->execute()) {
            echo 'Se guardó correctamente.';
        } else {
            echo 'Error al actualizar el contador de vistas.';
        }
        $stmt->close();
    } else {
        echo 'Error al preparar la consulta.';
    }

    $conn->close();
}


?>