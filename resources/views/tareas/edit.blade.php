<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 400px;
            padding: 25px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 15px;
            width: 100%;
            background: #8e44ad;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

</head>
<body>

<div class="container">

    @include('partials.volver')

    <h2>Editar Tarea</h2>

    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf

        <label>Texto de la tarea:</label>
        <input type="text" name="texto" value="{{ $tarea->texto }}" required>

        <button type="submit">Guardar cambios</button>
    </form>

</div>

</body>
</html>

