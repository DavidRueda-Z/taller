<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Encuestas</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 600px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        textarea {
            height: 80px;
        }

        button {
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1e8a4c;
        }

        .encuesta {
            background: #fafafa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-bottom: 12px;
        }

        .pregunta {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .opcion {
            padding-left: 15px;
        }

        a.eliminar {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        a.eliminar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Plataforma de Encuestas</h1>

    <form method="POST" action="{{ route('encuestas.store') }}">
        @csrf

        <label>Pregunta</label>
        <input type="text" name="pregunta" required>

        <label>Opciones (una por línea)</label>
        <textarea name="opciones" required></textarea>

        <button type="submit">Crear Encuesta</button>
    </form>

    <hr>

    @forelse ($encuestas as $e)
        <div class="encuesta">
            <div class="pregunta">{{ $e->pregunta }}</div>

            @foreach ($e->opciones as $op)
                <div class="opcion">• {{ $op }}</div>
            @endforeach

            <br>

            <a class="eliminar"
               href="{{ route('encuestas.destroy', $e->id) }}"
               onclick="return confirm('¿Eliminar esta encuesta?')">
               Eliminar
            </a>
        </div>
    @empty
        <p style="text-align:center;">No hay encuestas registradas</p>
    @endforelse

</div>

</body>
</html>
