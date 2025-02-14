<?php

// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');


if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

// Obtener todos los libros
function obtenerLibros() {
    return $_SESSION['libros'];
}

// Agregar un nuevo libro
function agregarLibro($titulo, $autor, $precio, $cantidad) {
    if (!empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0) {
        $nuevoLibro = [
            'id' => uniqid(), // Genera un ID único
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float)$precio,
            'cantidad' => (int)$cantidad
        ];
        $_SESSION['libros'][] = $nuevoLibro;
        return true;
    }
    return false;
}

// Actualizar un libro existente
function actualizarLibro($index, $titulo, $autor, $precio, $cantidad) {
    $titulo = trim(htmlspecialchars($titulo));
    $autor = trim(htmlspecialchars($autor));

    if (isset($_SESSION['libros'][$index]) && !empty($titulo) && !empty($autor) && is_numeric($precio) && $precio > 0 && is_numeric($cantidad) && $cantidad > 0) {
        $_SESSION['libros'][$index] = [
            'titulo' => $titulo,
            'autor' => $autor,
            'precio' => (float)$precio,
            'cantidad' => (int)$cantidad
        ];
        return true;
    }
    return false;
}

// Función para eliminar un libro por su ID único
function eliminarLibro($id) {
    $libros = obtenerLibros(); // Obtener todos los libros de la sesión

    // Recorremos los libros para encontrar el libro con el ID que queremos eliminar
    foreach ($libros as $key => $libro) {
        if ($libro['id'] === $id) { // Comparar el ID único
            unset($libros[$key]); // Eliminar el libro del array
            $_SESSION['libros'] = array_values($libros); // Reindexar el array después de eliminar
            return true;
        }
    }
    return false; // Si no se encuentra el libro con ese ID
}

// Gestionar el envío de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $index = isset($_POST['index']) && is_numeric($_POST['index']) ? (int)$_POST['index'] : -1;
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $cantidad = $_POST['cantidad'] ?? 0;

    switch ($accion) {
        case 'agregar':
            if (agregarLibro($titulo, $autor, $precio, $cantidad)) {
                $mensaje = "Libro registrado exitosamente.";
            } else {
                $mensajeError = "Error al registrar el libro. Verifica los datos ingresados.";
            }
            break;

        case 'actualizar':
            if (actualizarLibro($index, $titulo, $autor, $precio, $cantidad)) {
                $mensaje = "Libro actualizado exitosamente.";
            } else {
                $mensajeError = "Error al actualizar el libro. Verifica los datos ingresados.";
            }
            break;

            case 'eliminar':
                $id = $_POST['id'] ?? '';
                if (eliminarLibro($id)) {
                    $mensaje = "Libro eliminado exitosamente";
                } else {
                    $mensajeError = "Error al eliminar el libro";
                }
                break;
    }
}
?>