
<?php
$servidor = "localhost"; 
$usuario_bd = "root"; // Tu nombre de usuario de MySQL (puede ser diferente en tu caso)
$contrasena_bd = ""; // Tu contraseña de MySQL (puede ser diferente en tu caso)
$nombre_bd = "file"; // Nombre de la base de datos que creaste

// Crear la conexión
$conexion = new mysqli($servidor, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>