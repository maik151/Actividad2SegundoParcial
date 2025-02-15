<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Biblioteca</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
    <script src="https://kit.fontawesome.com/c13ee7e503.js" crossorigin="anonymous"></script>

</head>
<body class='bodyContacts'>

    <?php include '../includes/navbar.php'; ?>
    <div class="containnerContactos">
        <div class="seccion-ubicacion-experiencia">
            <div class="bloque-ubicacion">
                <h3>UBICACIÓN:</h3>
                <p>Avenida Naciones Unidas, frente al parque La Carolina</p>
                <div class="contenedor-mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3355.008126581385!2d-78.48541500913143!3d-0.1758209192701981!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sec!4v1739586402559!5m2!1ses!2sec" width="500" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                    <h2>Nuestras Redes</h2>
                    <div class="iconos-redes">
                    <span class="facebook"><i class="fa-brands fa-facebook"></i></span>
                    <span class="twitter"><i class="fa-brands fa-x-twitter"></i></span>
                    <span class="instagram"><i class="fa-brands fa-instagram"></i></span>
                    <span class="youtube"><i class="fa-brands fa-youtube"></i></span>
                </div>
            </div>
            <div class="bloque-experiencia">
                <h3>CUÉNTANOS TU EXPERIENCIA</h3>
                <textarea placeholder="Escribe una reseña"></textarea>
                <input type="text" placeholder="Tu nombre!">
                <button class="boton-enviar">Enviar</button>
            </div>
        </div>
    </div>


</body>