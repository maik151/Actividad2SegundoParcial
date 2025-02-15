<?php
// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');
require_once '../includes/functions.php';
$libros = obtenerLibros();
var_dump($_SERVER['REQUEST_METHOD']);
var_dumP($_POST);


$datos = manejarAccionFormulario();
$mensaje = $datos['mensaje'];
$mensajeError = $datos['mensajeError'];

$libros = obtenerLibros();
//Funcion de rtenderizar
function renderizarTabla($libros){
    if(empty($libros)){
        echo "<tr><td colspan='6'>No existen libros registrados</td></tr>";
    } else {
        foreach($libros as $index => $libro){
            echo "
                <tr>
                    <td>".($index+1)."</td>
                    <td>".$libro['titulo']."</td>
                    <td>".$libro['autor']."</td>
                    <td>$".number_format($libro['precio'], 2)."</td>
                    <td>".$libro['cantidad']."</td>
                    <td>
                        <form method='POST' style='display: inline;'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='index' value='".$index."'>
                            <button type='submit' onclick='return confirm(\"¿Está seguro de eliminar este libro?\")'>
                                Eliminar
                            </button>
                        </form>
                        
                            <button type = 'button' onclick = 'editarLibro(".$index.")'>
                                Editar
                            </button>
                    </td>
                </tr>
            ";
        }
        
    }   
}
?>
<?php if ($mensaje): ?>
    <div class="mensaje"><i class="fa-regular fa-circle-check"></i><?php echo $mensaje; ?></div>
<?php endif; ?>
<?php if ($mensajeError): ?>
    <div class="mensaje"><i class="fa-regular fa-circle-xmark"></i><?php echo $mensajeError; ?></div>
<?php endif; ?>


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
    <div id="modal-editar">
        <h3>Editar Libro</h3>
        <form id="form-libro2" method="POST">
                    <input type="hidden" name="accion" value="agregar">
                    <input type="hidden" id="index" name="index">
                    
                    <label for="titulo">Título del libro:</label><br>
                    <input type="text" id="titulo" name="titulo" required><br>
                    
                    <label for="autor">Nombre del autor:</label><br>
                    <input type="text" id="autor" name="autor" required><br>
                    
                    <label for="precio">Precio:</label><br>
                    <input type="number" id="precio" name="precio" step="0.01" min="0" required><br>
                    
                    <label for="cantidad">Cantidad de ejemplares:</label><br>
                    <input type="number" id="cantidad" name="cantidad" min="1" required><br>
                    
                    <button type="submit">Registrar</button>
                    <button type="button" onclick="limpiarFormulario()">Limpiar</button>
                </form>
    </div>
    <div class="container">
        <h1>Lista de Libros</h1>
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
        
        // Verifica si existe un mensaje y lo oculta después de 3 segundos
        document.addEventListener('DOMContentLoaded', function() {
        const mensaje = document.querySelector('.mensaje');
        if (mensaje) {
            setTimeout(() => {
                mensaje.style.opacity = '0';  // Desaparece el mensaje
                setTimeout(() => mensaje.style.display = 'none', 500); // Lo oculta completamente después de 0.5s
            }, 3000);  // Espera 3 segundos antes de iniciar la animación
        }
        });

        function editarLibro(index) {
            const libros = <?php echo json_encode($libros); ?>;
            const libro = libros[index];
            
            document.getElementById('index').value = index;
            document.getElementById('titulo').value = libro.titulo;
            document.getElementById('autor').value = libro.autor;
            document.getElementById('precio').value = libro.precio;
            document.getElementById('cantidad').value = libro.cantidad;
            
            document.querySelector('input[name="accion"]').value = 'actualizar';
            document.querySelector('button[type="submit"]').textContent = 'Actualizar';
        }


    



    </script>
</body>
</html>