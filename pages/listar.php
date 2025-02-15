<?php
// incluimos el archivo de sesion.php para mantener la sesion
include('../includes/session.php');
require_once '../includes/functions.php';
$libros = obtenerLibros();


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
                            <button class = 'buttonT1' type='submit' onclick='return confirm(\"¿Está seguro de eliminar este libro?\")'>
                                <i class=\"fa-regular fa-trash-can\"></i>
                            </button>
                        </form>

                        <button class = 'buttonT2' type='button' onclick='editarLibro(".$index.")'>
                            <i class=\"fa-solid fa-pencil\"></i>
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
    <link rel="stylesheet" href="public/css/estilos.css">
    <script src="https://kit.fontawesome.com/c13ee7e503.js" crossorigin="anonymous"></script>
</head>
<body >
<?php include '../includes/navbar.php'; ?>
    <div class="listarContainner">
        <div id="modal-editar">
            <div class="modal-content">
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
                    
                    <button type="submit">Actualizar</button>
                    <div type="">Presione ESC para salir</div>
                </form>
            </div>
        </div>
        <div class="container">
            <h1>Lista de Libros</h1>
            <table>
                <thead>
                    <tr>
                        <th id='idTable'>#ID</th>
                        <th id='tituloTable'>Título</th>
                        <th id='autorTable'>Autor</th>
                        <th id='precioTable'>Precio</th>
                        <th id='cantidadTable'>Cantidad</th>
                        <th id='accionesTable'>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php renderizarTabla($libros); ?>
                </tbody>
            </table>
        </div>
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
            
            // Mostrar el modal
            const modal = document.getElementById('modal-editar');
            modal.style.display = 'block';

            // Cerrar modal al hacer clic fuera del formulario
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };

            // Cerrar modal al presionar Escape
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    modal.style.display = 'none';
                }
            });

        }
        
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