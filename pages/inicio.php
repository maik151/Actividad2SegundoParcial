<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            text-align: center;
        }
        
        h1 {
            margin-bottom: 20px;
        }

        .contenedor {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 200px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 16px;
        }

        .card p {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<h1>📚 Descubre tu próxima lectura 📚</h1>

<div class="contenedor">
    <!-- Libro 1 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 1">
        <h3>El Misterio Oculto</h3>
        <p>Autor: Juan Pérez</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 2 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 2">
        <h3>Aventuras en la Luna</h3>
        <p>Autor: María López</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 3 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 3">
        <h3>La Sombra Perdida</h3>
        <p>Autor: Carlos Ramírez</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 4 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 4">
        <h3>Secretos del Pasado</h3>
        <p>Autor: Ana González</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 5 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 5">
        <h3>El Reino Perdido</h3>
        <p>Autor: Luis Fernández</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 6 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 6">
        <h3>El Último Guerrero</h3>
        <p>Autor: Pedro Sánchez</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 7 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 7">
        <h3>Viaje a lo Desconocido</h3>
        <p>Autor: Sofía Martínez</p>
        <a href="#" class="btn">Ver más</a>
    </div>

    <!-- Libro 8 -->
    <div class="card">
        <img src="https://via.placeholder.com/200x250" alt="Libro 8">
        <h3>Código Secreto</h3>
        <p>Autor: Miguel Torres</p>
        <a href="#" class="btn">Ver más</a>
    </div>
</div>



</body>
</html>

