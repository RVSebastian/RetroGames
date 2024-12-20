<?php

try {
    // Intentar conectar al servidor local
    $conn = mysqli_connect(
        'sql529.main-hosting.eu',
        'u667101417_automarcol',
        'Automarcol+2023*',
        'u667101417_automarcol'
    );

    if ($conn->connect_errno) {
        // Si no se pudo establecer una conexión al servidor local, se lanza una excepción
        throw new Exception("No se pudo conectar al servidor");
    }
} catch (Exception $e) {
    // Captura la excepción y muestra un mensaje de error si la conexión al servidor local falla
    echo "Error: " . $e->getMessage() . "<br>";

    // Intentar conectar al servidor remoto
    $conn = mysqli_connect(
        'localhost',
        'u667101417_automarcol',
        'Automarcol+2023*',
        'u667101417_automarcol'
    );

    if ($conn->connect_errno) {
        // Si no se pudo establecer una conexión al servidor remoto, muestra un mensaje de error
        echo "<script>console.log('No se pudo conectar al servidor')</script>;";
        exit();
    }
}

// Aquí puedes usar la conexión $conn para realizar tus consultas


?>
