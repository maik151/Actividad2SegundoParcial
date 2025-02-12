<?php
// index.php
session_start();

if(!isset($_SESSION['libros'])){
    $_SESSION['libros'] = [];
}

function obtenerLibros(){
    return $_SESSION['libros'];
}

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

function eliminarLibro($index){
    if(isset($_SESSION['libros'][$index])){
        array_splice($_SESSION['libros'], $index, 1);
        return true;
    }
    return false;
}

// Gestionar el envío de valores del formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['accion'])){
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
}

$libros = obtenerLibros();

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
                        <button onclick='editarLibro(".$index.")'>Editar</button>
                    </td>
                </tr>
            ";
        }
    }   
}
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Gestión de Libros</title>
        <style>
            nav {
                background-color: #333;
                padding: 1em;
                margin-bottom: 2em;
            }
            nav a {
                color: white;
                text-decoration: none;
                padding: 0.5em 1em;
            }
            nav a:hover {
                background-color: #555;
            }
            .form-container {
                margin-bottom: 2em;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            input, button {
                margin: 0.5em 0;
                padding: 0.5em;
            }
            .mensaje {
                padding: 1em;
                margin: 1em 0;
                border-radius: 4px;
            }
            .exito {
                background-color: #dff0d8;
                color: #3c763d;
            }
            .error {
                background-color: #f2dede;
                color: #a94442;
            }
        </style>
    </head>
    <body>
        <nav>
            <a href="#inicio">Inicio</a>
            <a href="#registrar">Registrar Libro</a>
            <a href="#listado">Listado de Libros</a>
            <a href="#contacto">Contacto</a>
        </nav>

        <div class="container">
            <h1>Gestión de Libros</h1>
        
        <?php if(isset($mensaje)): ?>
            <div class="mensaje exito"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        
        <?php if(isset($mensajeError)): ?>
            <div class="mensaje error"><?php echo $mensajeError; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <h2>Registro de Libro</h2>
            <form id="form-libro" method="POST">
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

        <h2>Lista de Libros</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
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

        function limpiarFormulario() {
            document.getElementById('form-libro').reset();
            document.getElementById('index').value = '';
            document.querySelector('input[name="accion"]').value = 'agregar';
            document.querySelector('button[type="submit"]').textContent = 'Registrar';
        }
    </script>
</body>
</html>


