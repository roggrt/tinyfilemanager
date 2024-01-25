<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "file";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para crear un nuevo usuario
function crearUsuario($usuario, $contrasena, $ruta, $descripcion) {
    global $conn;
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (usuario, contrasena, ruta, descripcion) VALUES ('$usuario', '$hashedPassword', '$ruta', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario creado exitosamente";
    } else {
        echo "Error al crear el usuario: " . $conn->error;
    }
}

// Función para obtener todos los usuarios
function obtenerUsuarios() {
    global $conn;
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Usuario: " . $row["usuario"]. " - Ruta: " . $row["ruta"]. "<br>";
        }
    } else {
        echo "No se encontraron usuarios";
    }
}

// Función para actualizar un usuario
function actualizarUsuario($id, $usuario, $contrasena, $ruta, $descripcion) {
    global $conn;
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET usuario='$usuario', contrasena='$hashedPassword', ruta='$ruta', descripcion='$descripcion' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }
}

// Función para eliminar un usuario
function eliminarUsuario($id) {
    global $conn;
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
}

// Ejemplos de uso
// Crear un nuevo usuario
crearUsuario("usuario1", "contrasena1", "/ruta/1", "Descripción 1");

// Obtener todos los usuarios
obtenerUsuarios();

// Actualizar un usuario existente (supongamos que el usuario con ID 1 existe)
actualizarUsuario(1, "nuevo_usuario", "nueva_contrasena", "/nueva_ruta", "Nueva descripción");

// Eliminar un usuario (supongamos que el usuario con ID 2 existe)
eliminarUsuario(2);

// Cerrar la conexión a la base de datos
$conn->close();
?>
