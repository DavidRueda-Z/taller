<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Encuestas</title>

    <style>
        body {
            font-family:Arial;
            background:#f4f4f4;
            padding:40px;
            display:flex;
            justify-content:center;
        }

        .container {
            width:800px;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,.1);
        }

        .encuesta {
            padding:10px 0;
            border-bottom:1px solid #ccc;
            margin-bottom:10px;
        }

        .btn-eliminar {
            background:#c0392b;
            padding:6px 10px;
            border:none;
            color:white;
            border-radius:5px;
            cursor:pointer;
            font-size:0.9rem;
            margin-top:8px;
        }

        .btn-votar {
            background:#3498db;
            border:none;
            padding:4px 8px;
            border-radius:4px;
            color:white;
            cursor:pointer;
            margin-left:10px;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Plataforma de Encuestas</h1>

    {{-- FORMULARIO --}}
    <form action="{{ route('encuestas.store') }}" method="POST">
        @csrf

        <label>Pregunta:</label>
        <input type="text" name="pregunta" required
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin-bottom:10px;">

        <label>Opciones (una por línea):</label>
        <textarea name="opciones" required
        style="width:100%; height:80px; padding:10px; border:1px solid #ccc; border-radius:6px;"></textarea>

        <button style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px; margin-top:10px;">
            Crear Encuesta
        </button>
    </form>

    <hr><br>

    {{-- LISTA DE ENCUESTAS --}}
    @foreach ($encuestas as $e)
        <div class="encuesta">

            {{-- Pregunta --}}
            <h3>{{ $e->pregunta }}</h3>

            {{-- Opciones con votos --}}
            <ul>
                @foreach ($e->opciones as $index => $op)
                    <li>
                        {{ $op->texto }}
                        — <strong>{{ $op->votos }} votos</strong>

                        {{-- Botón votar --}}
                        <form
                            action="{{ route('encuestas.votar', ['id' => $e->id, 'opcion' => $index]) }}"
                            method="POST"
                            style="display:inline;">
                            @csrf
                            <button class="btn-votar">Votar</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            {{-- Botón eliminar --}}
            <form action="{{ route('encuestas.destroy', $e->id) }}" method="POST">
                @csrf
                <button class="btn-eliminar" onclick="return confirm('¿Eliminar esta encuesta?')">
                    Eliminar encuesta
                </button>
            </form>

        </div>
    @endforeach

</div>

</body>
</html>


