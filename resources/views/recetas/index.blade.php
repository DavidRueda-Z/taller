<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Recetas</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 750px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 15px;
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
            height: 80px;
        }

        button {
            background: #c0392b;
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
            background: #a93226;
        }

        .receta {
            background: #fafafa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-bottom: 12px;
        }

        .titulo {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .categoria {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-weight: bold;
            margin-top: 8px;
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

    <h1>Plataforma de Recetas</h1>

    <form method="POST" action="{{ route('recetas.store') }}">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Categoría</label>
        <select name="categoria" required>
            <option value="Postre">Postre</option>
            <option value="Plato fuerte">Plato fuerte</option>
            <option value="Bebida">Bebida</option>
            <option value="Entrada">Entrada</option>
            <option value="Ensalada">Ensalada</option>
            <option value="Otros">Otros</option>
        </select>

        <label>Ingredientes</label>
        <textarea name="ingredientes" required></textarea>

        <label>Preparación</label>
        <textarea name="preparacion" required></textarea>

        <button type="submit">Guardar Receta</button>
    </form>

    <hr>

    @forelse ($recetas as $r)
        <div class="receta">
            <div class="titulo">{{ $r->titulo }}</div>
            <div class="categoria">Categoría: {{ $r->categoria }}</div>

            <div class="subtitulo">Ingredientes:</div>
            <div>{!! nl2br(e($r->ingredientes)) !!}</div>


            <div class="subtitulo">Preparación:</div>
            <div>{!! nl2br(e($r->preparacion)) !!}</div>

            <br>

            <a href="{{ route('recetas.edit', $r->id) }}">Editar</a> |

            <a class="eliminar"
               href="{{ route('recetas.destroy', $r->id) }}"
               onclick="return confirm('¿Eliminar esta receta?')">
               Eliminar
            </a>
        </div>
    @empty
        <p style="text-align:center;">No hay recetas registradas</p>
    @endforelse

</div>

</body>
</html>
