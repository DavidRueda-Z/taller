<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Notas</title>

    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; display:flex; justify-content:center; }
        .container { width:800px; background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
        .nota { border-bottom:1px solid #ccc; padding:10px 0; margin-bottom:10px; }
        .btn { padding:6px 10px; border-radius:5px; text-decoration:none; color:white; }
        .editar { background:#f1c40f; }
        .eliminar { background:#c0392b; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Gestor de Notas</h1>

    {{-- FORMULARIO --}}
    <form action="{{ route('notas.store') }}" method="POST">
        @csrf

        <input type="text" name="titulo" placeholder="Título" required
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin-bottom:8px;">

        <textarea name="contenido" placeholder="Contenido" required
        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; height:80px;"></textarea>

        <button style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px; margin-top:10px;">
            Agregar Nota
        </button>
    </form>

    <hr><br>

    {{-- LISTA DE NOTAS --}}
    @foreach ($notas as $nota)
        <div class="nota">
            <h3>{{ $nota->titulo }}</h3>
            <p>{{ $nota->contenido }}</p>

            <a href="{{ route('notas.edit', $nota->id) }}" class="btn editar">Editar</a>

            <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn eliminar" onclick="return confirm('¿Eliminar nota?')">Eliminar</button>
            </form>
        </div>
    @endforeach

</div>

</body>
</html>
