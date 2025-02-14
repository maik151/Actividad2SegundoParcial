

<?php
// Codigo basado en propocionado para la gestion de productos.

// index.php
//Primero inciamos una sesion\
//  Es una función en PHP que inicia una sesión o reanuda una sesión
//   existente en el servidor. Una sesión permite almacenar información
//    en el servidor y asociarla a un usuario en particular a través de
//     un identificador único (ID de sesión). Esta información se mantiene
//      disponible en todas las páginas durante la navegación del usuario,
//       y se puede utilizar para almacenar datos como preferencias, información
//        de login, o cualquier otro dato relevante entre diferentes solicitudes HTTP.
session_start();

// isset comprueba que como tal si no existe ya una variable definida copn el nombre $SESSION_['libros]
// si no existe una variable como tal, se crea o se inizializa un arreglo vacio con ese mismo nombre
if(!isset($_SESSION['libros'])){
    $_SESSION['libros'] = [];
}

// La funcion, retorna como tal la variable $SESSION_['libros], es decir devuelve el
// contenido de la lista de libros
function obtenerLibros(){
    return $_SESSION['libros'];
}


//Que hace la funcion agregarLibro()
// la funcion toma como parametros $titlo, $autor, $precio, $cantidad
// primero verifica que las variables de titulo, y autor, no sean diferentes de vacio (!empty)
// y ademas verifica que $precio y $cantidad, sean mayores que 0
// si ersa condicion se cumple, entonces manda a llamar a la variable libro y se asgina 
//  un array con los valores puestos en el parametro
// Devuelve true si se agregó con éxito, o false si los datos no son válidos.
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

//Que hace la funcion actualizar?
// primero pasa como parametros todo adicionando el parametro $index
// primero se valida que exista un array declarado dentro de $SESSION_['libros] en el indice indicado
// luego hace las demas verificaciones (que titulo sea diferente de vacio (!empty) y que las variables numericas sean mayores a 0)

// Si ce cumplen estas condiciens, entonces, en ese libro definido en $SESSION_['libros] segun el indice dado
// se reemplazan los valores designados.
// ademas de que si se cumplen todas las condiciones retorna true, si no retorna false
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


// Que hace lka funcion eliminar libro
// eliminarLibro() topm,a como parametro un indice $index
// 77 - comprueba que exista un libro asignado en el array $SESSION_['libros] definido en ese indice.
// 78 - si se cumple la condicion, la funcion array_splice(), toma coomo parametro 3 cosas
// el array, el indice, y los elementos que se quieren eliminar alrededor de ese indice, en este caso, 1
// como tal se basa en el indice obtenido por el parametro, y elimina el elemento definido por el mismo indice
// ademas de que retorna true si se cumple, o retorna false si no se cumple.
function eliminarLibro($index){
    if(isset($_SESSION['libros'][$index])){
        array_splice($_SESSION['libros'], $index, 1);
        return true;
    }
    return false;
}


//Primero la condicion es si $_SERVER['REQUEST_METHOD] es si o si igual a POST entonces
// recordemos que $_SERVER['REQUEST_METHOD] es una variable de ambito GLOBAL que contiene
// el metodo HTTP utilizado para realizar la solicitud, es decir esta variable es igual a
// a que metodo se uso para enviar los datos, en ester caso la condicion es, si se cumple que 
// esta variable es si o si igual a POST, entonces se ejecuta todo lo demas

//luego se crea otro condicional que comprueba que 
// Gestionar el envío de valores del formulario

//cuyando se envian datos a traves de POST, los datos del formulario, se almacenan en el arreglo
// POST, donde cada campo del formulario se convierte en una relacion CLAVE-VALOR

// En este caso 'accion', serial el nombre de un cambo del formulario, como puede ser input,
//  o button (y efectivamente en la linea 163, 254, se define en el <input> la palabra 'accion' )
// Entonces, $_POST['accion'] está accediendo al valor de ese campo específico que se envió en 
// el formulario, permitiendo que el código PHP actúe según lo que el usuario haya elegido o ingresado.

// Enotnces que hace esta linea
// if(isset($_POST['accion'])) -> verifica que exista el la variable, la key, la clave
// o el nombre 'accion', dentro del arreglo $_POST[], verifica que exista que este definido.


// $_POST['accion'] ES UNA VARIABLE, EL VALOR ES EL VALOR QUE TENGA SEGUN LA CLAVE

// si se cumnple esa condicion ahora por medio de un switch comprtueba que valoir tiene la variable
// $_POST['acccion'], en el caso 1, si ese valor de la clave es igual a 'agregar', entonces ejecuta
// obtiene el valor de la variable POST con respecto al titulo, autor, precio, y cantidad y si no existen o son null, asign valores por defecto
// usando '??', \
// depues de importar se puede decir el arreglo de $_POST[] los valores a las variables de
// $titulo, $autor, $precio, $cantidad; se ponen esas variables como parametro de la funcion de
// agregarLIbro(), la funcion como tal nos devuvle un valor bolleano, true, o false
// la condicinante es si es true, entonces mostrar un mensaje de exito, sino, mostrar un mensaje de error
// al registrar.

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
