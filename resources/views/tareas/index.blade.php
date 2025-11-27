<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>

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
            width: 500px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #2980b9;
        }

        ul {
            margin-top: 20px;
            padding: 0;
            list-style: none;
        }

        li {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            border: 1px solid #eee;
        }

        a {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .empty {
            text-align: center;
            color: #888;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">

        @include('partials.volver')


        <h1>Lista de Tareas</h1>

        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf
            <input type="text" name="tarea" placeholder="Escribe una tarea..." required>
            <button type="submit">Agregar</button>
        </form>

        <ul>
            @forelse ($tareas as $tarea)
                <li>
                    {{ $tarea->texto }}
                    <a href="{{ route('tareas.destroy', $tarea->id) }}">Eliminar</a>
                </li>
            @empty
                <p class="empty">No hay tareas registradas</p>
            @endforelse
        </ul>

    </div>

</body>
</html>

