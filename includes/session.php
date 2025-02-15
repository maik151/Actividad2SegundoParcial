
<?php
// con este archivo iniciamos una unica sesion para todo el proyecto.
// ester archivoi debe incluirse en todas las paginas, para no iniciar una sesion por cada una

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>