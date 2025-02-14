<?php
// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');
require_once '../includes/functions.php';
include '../includes/navbar.php';

// isset comprueba que como tal si no existe ya una variable definida copn el nombre $SESSION_['libros]
// si no existe una variable como tal, se crea o se inizializa un arreglo vacio con ese mismo nombre
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}


$datos = manejarAccionFormulario();
$mensaje = $datos['mensaje'];
$mensajeError = $datos['mensajeError'];

// Redireccionar para evitar el reenvío del formulario
// Redirigir para evitar el reenvío del formulario

var_dump($_SESSION['libros']);
?>

<?php if ($mensaje): ?>
    <div class="mensaje exito"><i class="fa-regular fa-circle-check"></i><?php echo $mensaje; ?></div>
<?php endif; ?>
<?php if ($mensajeError): ?>
    <div class="mensaje error"><i class="fa-regular fa-circle-xmark"></i><?php echo $mensajeError; ?></div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Libro</title>
    <link rel="stylesheet" href="public/css/estilos.css">
    <script src="https://kit.fontawesome.com/c13ee7e503.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container_register">
        
        <div class="box_form_register">
            <div class="image_backgroud_register">
                <img src="../public/images/1x/Recurso 6.png" class="image_register">
            </div>

            <div class="form-container_register">
            <h1>Registro de Libro</h1>
                <form id="form-libro" method="POST">
                    <div class="inputs_boxs">            
                        <<input type="hidden" name="accion" value="agregar">
                        <input type="hidden" id="index" name="index">
                    </div>
                    <div class="inputs_boxs">            
                        <label for="titulo">Título del libro:</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div class="inputs_boxs">
                        <label for="autor">Nombre del autor:</label>
                        <input type="text" id="autor" name="autor" required>
                    </div>
                    <div class="inputs_boxs">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" required>
                    </div>
                    <div class="inputs_boxs">
                        <label for="cantidad">Cantidad de ejemplares:</label>
                        <input type="number" id="cantidad" name="cantidad" min="1" required>
                    </div>
                    <div class="button_boxs">
                        <button type="submit">Registrar</button>
                        <button type="button" onclick="limpiarFormulario()">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <script>
        function limpiarFormulario() {
            document.getElementById('form-libro').reset();
        }

        // Verifica si existe un mensaje y lo oculta después de 3 segundos
        document.addEventListener('DOMContentLoaded', function() {
        const mensaje = document.querySelector('.mensaje');
        if (mensaje) {
            setTimeout(() => {
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.style.display = 'none', 500);
            }, 3000);
        }
    });
    </script>
</body>
</html>
