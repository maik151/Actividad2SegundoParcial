<?php
session_start();
include '../includes/navbar.php';

if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

function agregarLibro($titulo, $autor, $precio, $cantidad) {
    if (!empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0) {
        $_SESSION['libros'][] = [
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float)$precio,
            'cantidad' => (int)$cantidad
        ];
        return true;
    }
    return false;
}

// Manejar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $cantidad = $_POST['cantidad'] ?? 0;

    if (agregarLibro($titulo, $autor, $precio, $cantidad)) {
        $mensaje = "Libro registrado exitosamente";
    } else {
        $mensajeError = "Error al registrar el libro";
    }
}
?>

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
        
        <div class="register_messeage">
            <?php if(isset($mensaje)): ?>
                <div class="mensaje exito"><i class="fa-regular fa-circle-check"></i><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <?php if(isset($mensajeError)): ?>
                <div class="mensaje error"><i class="fa-regular fa-circle-xmark"></i><?php echo $mensajeError; ?></div>
            <?php endif; ?>
        </div>
        

        

        <div class="box_form_register">
            <div class="image_backgroud_register">
                <img src="../public/images/1x/Recurso 6.png" class="image_register">
            </div>

            <div class="form-container_register">
            <h1>Registro de Libro</h1>
                <form id="form-libro" method="POST">
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
    </script>
</body>
</html>