<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Si ya ha iniciado sesión, redirigir a la página de vista
    header("Location: tinyfilemanager.php");
    exit();
}

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultar la base de datos para verificar las credenciales
    $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró un usuario con esas credenciales
    if ($resultado->num_rows > 0) {
        // Inicio de sesión exitoso
        $_SESSION['usuario'] = $usuario;
        
        // Redirigir al usuario a la página de vista
        header("Location: tinyfilemanager.php");
        exit();
    } else {
        $mensaje = "Inicio de sesión fallido. Verifica tus credenciales.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Enlazar Bootstrap desde CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 100px;
        }

        .card {
            max-width: 400px;
            margin: auto;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .btn-primary {
            width: 100%;
        }

        .alert {
            margin-top: 20px;
        }

        .card.mb-2 {
            max-width: 600px;
            margin: auto;
        }

        .card-header.d-flex.justify-content-between {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .btn-danger.btn-block {
            width: 100%;
        }

        .js-new-pwd.hidden {
            display: none;
        }

        .form-inline .form-group.mb-2 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Inicio de Sesión</h2>
            </div>
            <div class="card-body">
                <?php if (isset($mensaje)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="form-group position-relative">
                        <label for="contrasena">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="contrasena" required>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enlazar Bootstrap JS y jQuery desde CDN (opcional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
