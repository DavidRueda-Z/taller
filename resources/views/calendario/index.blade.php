<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>

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

        input, textarea {
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
            background: #e67e22;
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
            background: #cf6e1f;
        }

        .evento {
            background: #fafafa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-bottom: 10px;
        }

        .titulo {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .fecha {
            color: #777;
            font-size: 0.9rem;
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

    <h1>Calendario de Eventos</h1>

    <form method="POST" action="{{ route('eventos.store') }}">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Fecha</label>
        <input type="date" name="fecha" required>

        <button type="submit">Agregar Evento</button>
    </form>

    <hr>

    @forelse ($eventos as $e)
        <div class="evento">
            <div class="titulo">{{ $e->titulo }}</div>
            <div>{{ $e->descripcion }}</div>
            <div class="fecha">Fecha: {{ $e->fecha }}</div>

            <a class="eliminar"
               href="{{ route('eventos.destroy', $e->id) }}"
               onclick="return confirm('¿Eliminar este evento?')">
               Eliminar
            </a>
        </div>
    @empty
        <p style="text-align:center;">No hay eventos registrados</p>
    @endforelse

</div>

</body>
</html>
