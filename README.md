# Actividad2SegundoParcial
Integrantes:
- Michael Jimenez
- Edison Chiluiza
- Nathaly Loor
- -------------------------------------------------------------------------------------
📚 Proyecto de Gestión de Libros

📖 Descripción

Este proyecto es un sistema web desarrollado en PHP para la gestión de libros y autores. Permite registrar, listar, actualizar y eliminar libros de una base de datos. También cuenta con sesiones para manejar usuarios y una interfaz sencilla y organizada.

🚀 Características

📌 Registro de libros con detalles como título, autor y año de publicación.

📋 Listado de libros almacenados en la base de datos.

✏️ Edición y eliminación de registros.

🔒 Manejo de sesiones para mantener la seguridad.

🌐 Interfaz organizada con HTML, CSS y JavaScript.

📂 Estructura del Proyecto

Miproyecto/
│── includes/              # Contiene archivos de funciones y sesiones
│   │── functions.php      # Funciones reutilizables del sistema
│   │── navbar.php        # Menú de navegación principal
│   │── session.php       # Manejo de sesiones
│
│── pages/                # Contiene las páginas principales
│   │── contacto.php      # Página de contacto con información general
│   │── inicio.php        # Página de inicio con libros aleatorios
│   │── listar.php        # Página que muestra todos los libros registrados
│   │── register.php      # Página con el formulario para agregar libros
│
│── public/               # Archivos públicos como estilos y scripts
│   │── css/              # Hojas de estilo
│   │   ├── estilos.css   # Estilos generales del sistema
│   │── images/           # Imágenes usadas en el proyecto
│
│── example.php           # Archivo de prueba para funcionalidades
│── index.php             # Página principal del proyecto
│── README.md             # Documentación del proyecto

⚙️ Instalación y Configuración

Clonar el repositorio o descargar los archivos:

git clone https://github.com/tuusuario/miproyecto.git

Mover la carpeta al directorio de XAMPP:

mv miproyecto /xampp/htdocs/

Iniciar Apache y MySQL en XAMPP.

Importar la base de datos desde phpMyAdmin con el archivo SQL correspondiente.

Abrir el navegador y acceder al proyecto:

http://localhost/miproyecto/

🛠️ Tecnologías Utilizadas

PHP → Lógica del servidor y gestión de datos.

MySQL → Base de datos para almacenar la información de los libros.

HTML/CSS → Estructura y estilos de la interfaz de usuario.

JavaScript → Interactividad y validaciones en el frontend.

XAMPP → Servidor local para ejecutar el proyecto.

