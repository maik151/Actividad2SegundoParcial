<?php
// /includes/funciones.php
session_start();

if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

function obtenerLibros() {
    return $_SESSION['libros'];
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
?>