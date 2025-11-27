<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios PHP con Laravel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            width: 600px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            display: block;
            background: #eaeaea;
            padding: 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            color: #333;
        }

        .menu a:hover {
            background: #d4d4d4;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ejercicios PHP - Laravel</h1>

    <ul class="menu">
        <li><a href="{{ route('tareas.index') }}">1. Lista de Tareas (Laravel)</a></li>
        <li><a href="{{ url('/propinas') }}">2. Calculadora de Propinas</a></li>
        <li><a href="{{ url('/contrasenas') }}">3. Generador de Contraseñas</a></li>
        <li><a href="{{ url('/gastos') }}">4. Gestor de Gastos</a></li>
        <li><a href="{{ url('/reservas') }}">5. Sistema de Reservas</a></li>
        <li><a href="{{ url('/notas') }}">6. Gestor de Notas</a></li>
        <li><a href="{{ url('/calendario') }}">7. Calendario de Eventos</a></li>
        <li><a href="{{ url('/recetas') }}">8. Plataforma de Recetas</a></li>
        <li><a href="{{ url('/memoria') }}">9. Juego de Memoria</a></li>
        <li><a href="{{ url('/encuestas') }}">10. Plataforma de Encuestas</a></li>
        <li><a href="{{ url('/cronometro') }}">11. Cronómetro</a></li>
    </ul>

</div>

</body>
</html>
