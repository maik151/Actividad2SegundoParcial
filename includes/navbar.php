<head>
<link rel="stylesheet" href="../public/css/estilos.css">

</head>
<nav class="navbar">
    <a href="inicio.php" class="navbar-logo">
        <img src="../public/images/1x/Recurso 1.png" alt="Librería">
    </a>
    <ul class="navbar-menu">
        <li><a href="inicio.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'inicio.php' ? 'active' : ''; ?>">Inicio</a></li>
        <li><a href="register.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>">Registrar Libros</a></li>
        <li><a href="listar.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'listar.php' ? 'active' : ''; ?>">Lista de Libros</a></li>
        <li><a href="contactos.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contactos.php' ? 'active' : ''; ?>">Contacto</a></li>
    </ul>
</nav>
