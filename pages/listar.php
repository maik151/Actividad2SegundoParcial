<?php
// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');
require_once '../includes/functions.php';
$libros = obtenerLibros();

// Verificar si se recibió la acción de eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    // Llamar a la función de eliminar desde functions.php
    if (eliminarLibro($id)) {
        $_SESSION['mensaje'] = "Libro eliminado exitosamente";
        var_dump($_SESSION); // Verificar el estado de la sesión
    } else {
        $_SESSION['mensajeError'] = "Error al eliminar el libro";
    }
    
    // Redirigir para evitar resubir el formulario al actualizar la página
    header('Location: ../pages/listar.php');
    exit();
}


// Función para renderizar la tabla de libros
function renderizarTabla($libros) {
    if (empty($libros)) {
        echo "<tr><td colspan='6'>No existen libros registrados</td></tr>";
    } else {
        $contador = 1;
        foreach ($libros as $libro) {
            echo "
                <tr>
                    <td>" . $contador . "</td>
                    <td>" . htmlspecialchars($libro['titulo']) . "</td>
                    <td>" . htmlspecialchars($libro['autor']) . "</td>
                    <td>$" . number_format($libro['precio'], 2) . "</td>
                    <td>" . $libro['cantidad'] . "</td>
                    <td>
                        <form method='POST' action='listar.php' style='display: inline;'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='id' value='".htmlspecialchars($libro['id'])."'>
                            <button type='submit' onclick='return confirm(\"¿Está seguro de eliminar este libro?\")'>
                                Eliminar
                            </button>
                        </form>
                        <button onclick='editarLibro(\"" . htmlspecialchars($libro['id']) . "\")'>Editar</button>
                    </td>
                </tr>
            ";
            $contador++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    
    <div class="container">
        <h1>Lista de Libros</h1>

        <!-- Mostrar mensaje de éxito o error -->
        <div class="register_messeage">
            <?php if(isset($_SESSION['mensaje'])): ?>
                <div class="mensaje exito"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
            <?php elseif(isset($_SESSION['mensajeError'])): ?>
                <div class="mensaje error"><?php echo $_SESSION['mensajeError']; unset($_SESSION['mensajeError']); ?></div>
            <?php endif; ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php renderizarTabla($libros); ?>
            </tbody>
        </table>
    </div>
    
    <script>
        function editarLibro(id) {
            window.location.href = 'editar.php?id=' + encodeURIComponent(id);
        }
    </script>
</body>
</html>