<?php
header("Location: pages/inicio.php");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['accion'])){
        switch($_POST['accion']){
            case 'agregar':
                $titulo = $_POST['titulo'] ?? '';
                $autor = $_POST['autor'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                $cantidad = $_POST['cantidad'] ?? 0;

                if(agregarLibro($titulo, $autor, $precio, $cantidad)){
                    $_SESSION['mensaje'] = "Libro registrado exitosamente";
                } else {
                    $_SESSION['mensajeError'] = "Error al registrar el libro";
                }
                break;

            case 'actualizar':
                $index = $_POST['index'] ?? -1;
                $titulo = $_POST['titulo'] ?? '';
                $autor = $_POST['autor'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                $cantidad = $_POST['cantidad'] ?? 0;

                if(actualizarLibro($index, $titulo, $autor, $precio, $cantidad)){
                    $_SESSION['mensaje'] = "Libro actualizado exitosamente";
                } else {
                    $_SESSION['mensajeError'] = "Error al actualizar el libro";
                }
                break;

            case 'eliminar':
                $index = $_POST['index'] ?? -1;
                if(eliminarLibro($index)){
                    $_SESSION['mensaje'] = "Libro eliminado exitosamente";
                } else {
                    $_SESSION['mensajeError'] = "Error al eliminar el libro";
                }
                break;
        }
        header("Location: ".$_SERVER['PHP_SELF']); 
        exit();
    }
}
exit;
?>