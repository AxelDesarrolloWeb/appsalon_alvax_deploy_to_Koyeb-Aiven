<?php
function conectarDB(): mysqli
{
    // Establecer puerto por defecto si no está definido
    $db_port = isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : 3306;
    
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME'],
        $db_port  // Usar el puerto definido o el por defecto
    );

    $db->set_charset("utf8");

    if ($db->connect_error) {
        // Es mejor loggear estos errores en lugar de mostrarlos en producción
        error_log("Error de conexión: " . $db->connect_error);
        error_log("errno de depuración: " . mysqli_connect_errno());
        error_log("error de depuración: " . mysqli_connect_error());
        exit;
    }
    return $db;
}