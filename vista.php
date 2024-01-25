<?php
// Iniciar sesión
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];

// Consultar la base de datos para obtener más información del usuario
$consulta_usuario = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado_usuario = $conexion->query($consulta_usuario);

// Verificar si se encontró información del usuario
if ($resultado_usuario->num_rows > 0) {
    $datos_usuario = $resultado_usuario->fetch_assoc();

    // Extraer información adicional del usuario
  
    $nombre = $datos_usuario['nombre'];
    $ruta = $datos_usuario['ruta'];
    $descripcion = $datos_usuario['descripcion'];

    // Puedes agregar más variables según los campos de tu tabla

    // Ejemplo de uso:
    echo "ID: $usuario<br>";
    echo "Nombre: $nombre<br>";
    echo "Ruta: $ruta<br>";
    echo "Descripción: $descripcion<br>";
} else {
    echo "No se encontró información del usuario.";
}
// Función para cerrar sesión
function cerrarSesion() {
    // Destruir la sesión
    session_destroy();

    // Redirigir al login
    header("Location: login.php");
    exit();
}

// Verificar si se hizo clic en "Cerrar sesión"
if (isset($_GET['cerrar_sesion'])) {
    cerrarSesion();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Página de Vista</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $usuario; ?></h2>
    <!-- Mostrar información adicional del usuario si es necesario -->
    <!-- Ejemplo: <p>Nombre: <?php echo $nombre; ?></p> -->
    <p>Contenido de la página de vista.</p>
    <a href="?cerrar_sesion=1">Cerrar sesión</a>
</body>
</html>
