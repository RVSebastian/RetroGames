<?php

include '../../includes/cn.php';


$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];
$contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
$rom = isset($_POST['rom']) ? $_POST['rom'] : ' ';


// Manejar archivo de portada
if (isset($_FILES['portada']) && $_FILES['portada']['error'] == UPLOAD_ERR_OK) {
    $portada = $_FILES['portada'];
    // Procesar archivo de portada
}

// Manejar archivos de capturas
$captures = [];
for ($i = 1; $i <= 4; $i++) {
    if (isset($_FILES["capture_$i"]) && $_FILES["capture_$i"]['error'] == UPLOAD_ERR_OK) {
        $captures[] = $_FILES["capture_$i"];
        // Procesar cada archivo de captura
    }
}

/*
echo json_encode([
    'titulo' => $titulo,
    'descripcion' => $descripcion,
    'categories' => $categories,
    'contenido' => $contenido,
    'rom' => $rom,
    'portada' => isset($portada) ? $portada : null,
    'captures' => $captures
]);
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['mod'] === 'delete') {
        // Validar y sanitizar el input recibido
        $id_juego = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
        if ($id_juego > 0) { // Verifica que el ID sea válido
            // Preparar la consulta
            $q = 'DELETE FROM games WHERE id = ?';
            $stmt = mysqli_prepare($conn, $q);
    
            if ($stmt) {
                // Asociar el parámetro
                mysqli_stmt_bind_param($stmt, 'i', $id_juego);
    
                // Ejecutar la consulta
                if (mysqli_stmt_execute($stmt)) {
                    echo 'El juego se eliminó correctamente.';
                } else {
                    echo 'Error al eliminar el juego: ' . mysqli_error($conn);
                }
    
                // Cerrar el statement
                mysqli_stmt_close($stmt);
            } else {
                echo 'Error al preparar la consulta: ' . mysqli_error($conn);
            }
        } else {
            echo 'ID inválido.';
        }
    } 

    if ($_POST['mod'] == 'edit') {
        $id_juego = $_POST['id_juego']; // ID del juego a editar
        
        // Recuperar datos actuales del juego desde la base de datos
        $sql_select = "SELECT nombre, descripcion, plataforma, categorias, contenido, game, type, portada, img1, img2, img3, img4, version, formato FROM games WHERE id = ?";
        if ($stmt_select = $conn->prepare($sql_select)) {
            $stmt_select->bind_param("i", $id_juego);
            $stmt_select->execute();
            $stmt_select->bind_result(
                $nombre_actual, $descripcion_actual, $plataforma_actual, $categorias_actual, 
                $contenido_actual, $game_actual, $type_actual, $portada_actual, $img1_actual, 
                $img2_actual, $img3_actual, $img4_actual, $version_actual, $formato_actual
            );
            $stmt_select->fetch();
            $stmt_select->close();
        } else {
            echo "Error al preparar la consulta SELECT: " . $conn->error;
            exit;
        }
        
        // Recopilar datos enviados por el formulario
        $nombre = !empty($_POST['titulo']) ? $_POST['titulo'] : $nombre_actual;
        $descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : $descripcion_actual;
        $plataforma = !empty($_POST['plataforma']) ? $_POST['plataforma'] : $plataforma_actual;
        $categorias = !empty($_POST['categories']) ? implode(",", $_POST['categories']) : $categorias_actual;
        $contenido = !empty($_POST['contenido']) ? $_POST['contenido'] : $contenido_actual;
        $game = !empty($_POST['rom']) ? $_POST['rom'] : $game_actual;
        $type = !empty($_POST['type']) ? $_POST['type'] : $type_actual;
        $version = !empty($_POST['version']) ? $_POST['version'] : $version_actual;
        $formato = !empty($_POST['formato']) ? $_POST['formato'] : $formato_actual;
        
        // Actualizar las imágenes solo si se proporcionan nuevas
        function updateImage($fileInputName, $target_dir, $current_image) {
            global $conn;
            $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
            if ($_FILES[$fileInputName]["size"] > 0) { // Verificar si se subió un archivo nuevo
                move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file);
                return basename($_FILES[$fileInputName]["name"]);
            } else {
                return $current_image; // Mantener la imagen actual si no se subió una nueva
            }
        }
        
        $target_dir = "uploads/$id_juego/";
        $portada = updateImage('portada', $target_dir, $portada_actual);
        $img1 = updateImage('capture_1', $target_dir, $img1_actual);
        $img2 = updateImage('capture_2', $target_dir, $img2_actual);
        $img3 = updateImage('capture_3', $target_dir, $img3_actual);
        $img4 = updateImage('capture_4', $target_dir, $img4_actual);
        
        // Actualizar la fila con los datos nuevos
        $sql_update = "UPDATE games SET nombre=?, descripcion=?, plataforma=?, categorias=?, contenido=?, game=?, type=?, portada=?, img1=?, img2=?, img3=?, img4=?, version=?, formato=? WHERE id=?";
        if ($stmt_update = $conn->prepare($sql_update)) {
            $stmt_update->bind_param(
                "ssssssssssssssi", 
                $nombre, $descripcion, $plataforma, $categorias, $contenido, $game, $type, 
                $portada, $img1, $img2, $img3, $img4, $version, $formato, $id_juego
            );
            if ($stmt_update->execute()) {
                echo "Juego actualizado correctamente.";
            } else {
                echo "Error al actualizar el juego: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            echo "Error preparando la consulta UPDATE: " . $conn->error;
        }
    
        $conn->close();
    }
    
    

    if ($_POST['mod'] == 'add') {
        $nombre = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $plataforma = $_POST['plataforma'];
        $categorias = implode(",", $_POST['categories']);
        $contenido = $_POST['contenido'];
        $game = $_POST['rom'];
        $type = $_POST['type'];
        $version = $_POST['version'] ?? ' ';
        $formato = $_POST['formato'] ?? ' ';
        
        $estado = 0; // Ejemplo, puedes cambiarlo según tu lógica
    
        $sql = "INSERT INTO games (nombre, descripcion, plataforma, categorias, contenido, game, estado, type, version, formato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("ssssssssss", $nombre, $descripcion, $plataforma, $categorias, $contenido, $game, $estado, $type, $version, $formato);
            
            if ($stmt->execute()) {
                $last_id = $stmt->insert_id;
        
                // Crear una carpeta para las imágenes
                $target_dir = "uploads/$last_id/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
        
                // Función para subir imágenes
                function uploadImage($fileInputName, $target_dir) {
                    global $conn; // Acceder a la conexión global
                    $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
                    move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file);
                    return basename($_FILES[$fileInputName]["name"]);
                }
        
                // Subir las imágenes y guardar los nombres en la base de datos
                $portada = uploadImage('portada', $target_dir);
                $img1 = uploadImage('capture_1', $target_dir);
                $img2 = uploadImage('capture_2', $target_dir);
                $img3 = uploadImage('capture_3', $target_dir);
                $img4 = uploadImage('capture_4', $target_dir);
        
                // Actualizar la fila con los nombres de las imágenes
                $sql_update = "UPDATE games SET portada=?, img1=?, img2=?, img3=?, img4=? WHERE id=?";
                if ($stmt_update = $conn->prepare($sql_update)) {
                    $stmt_update->bind_param("sssssi", $portada, $img1, $img2, $img3, $img4, $last_id);
                    if ($stmt_update->execute()) {
                        echo "Registro creado y actualizado correctamente.";
                    } else {
                        echo "Error actualizando el registro: " . $stmt_update->error;
                    }
                } else {
                    echo "Error preparando la consulta: " . $conn->error;
                }
            } else {
                echo "Error al ejecutar la consulta de inserción: " . $stmt->error;
            }
        
            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error preparando la consulta: " . $conn->error;
        }
        
    
        $conn->close();
    }
    
}
?>