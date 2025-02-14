<?php

// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');

//Verificar que la variable Exista.
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

// Obtener todos los libros
function obtenerLibros() {
    return $_SESSION['libros'];
}

// Agregar un nuevo libro
function agregarLibro($titulo, $autor, $precio, $cantidad){
    if(!empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0){
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

// Actualizar un libro existente
function actualizarLibro($index, $titulo, $autor, $precio, $cantidad){
    if(isset($_SESSION['libros'][$index]) && !empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0){
        $_SESSION['libros'][$index] = [
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float)$precio,
            'cantidad' => (int)$cantidad
        ];
        return true;
    }
    return false;
}


// Función para eliminar un libro por su ID
function eliminarLibro($index){
    if(isset($_SESSION['libros'][$index])){
        array_splice($_SESSION['libros'], $index, 1);
        return true;
    }
    return false;
}


// Gestionar el envío de formularios
function manejarAccionFormulario(){
    $mensaje = '';
    $mensajeError = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])){
            switch($_POST['accion']){
                case 'agregar':
                    $titulo = $_POST['titulo'] ?? '';
                    $autor = $_POST['autor'] ?? '';
                    $precio = $_POST['precio'] ?? 0;
                    $cantidad = $_POST['cantidad'] ?? 0;

                    if(agregarLibro($titulo, $autor, $precio, $cantidad)){
                        $mensaje = "Libro registrado exitosamente";
                    } else {
                        $mensajeError = "Error al registrar el libro";
                    }
                    break;
                    
                case 'actualizar':
                    $index = $_POST['index'] ?? -1;
                    $titulo = $_POST['titulo'] ?? '';
                    $autor = $_POST['autor'] ?? '';
                    $precio = $_POST['precio'] ?? 0;
                    $cantidad = $_POST['cantidad'] ?? 0;

                    if(actualizarLibro($index, $titulo, $autor, $precio, $cantidad)){
                        $mensaje = "Libro actualizado exitosamente";
                    } else {
                        $mensajeError = "Error al actualizar el libro";
                    }
                    break;

                case 'eliminar':
                    $index = $_POST['index'] ?? -1;
                    if(eliminarLibro($index)){
                        $mensaje = "Libro eliminado exitosamente";
                    } else {
                        $mensajeError = "Error al eliminar el libro";
                    }
                    break;
                }
            }

            return ['mensaje' => $mensaje, 'mensajeError' => $mensajeError];

}

?>