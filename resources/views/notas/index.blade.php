<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Notas</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 650px;
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
            margin-top: 10px;
            display: block;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        textarea {
            height: 90px;
        }

        button {
            background: #8e44ad;
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
            background: #6c2e8d;
        }

        .nota {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-bottom: 10px;
        }

        .titulo {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .categoria {
            color: #666;
            font-size: 0.9rem;
        }

        .fecha {
            color: #888;
            font-size: 0.8rem;
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

    <h1>Gestor de Notas</h1>

    <form method="POST" action="{{ route('notas.store') }}">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Contenido</label>
        <textarea name="contenido" required></textarea>

        <label>Categoría</label>
        <select name="categoria" required>
            <option value="Personal">Personal</option>
            <option value="Trabajo">Trabajo</option>
            <option value="Estudios">Estudios</option>
            <option value="Ideas">Ideas</option>
            <option value="Otros">Otros</option>
        </select>

        <button type="submit">Guardar Nota</button>
    </form>

    <hr>

    @forelse ($notas as $n)
        <div class="nota">
            <div class="titulo">{{ $n->titulo }}</div>
            <div>{{ $n->contenido }}</div>
            <div class="categoria">Categoría: {{ $n->categoria }}</div>
            <div class="fecha">Fecha: {{ $n->fecha }}</div>

            <a class="eliminar"
               href="{{ route('notas.destroy', $n->id) }}"
               onclick="return confirm('¿Eliminar esta nota?')">
               Eliminar
            </a>
        </div>
    @empty
        <p style="text-align:center;">No hay notas guardadas</p>
    @endforelse

</div>

</body>
</html>
