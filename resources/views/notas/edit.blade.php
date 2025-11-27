<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nota</title>

    <style>
        body { font-family:Arial; background:#f4f4f4; padding:40px; display:flex; justify-content:center; }
        .container { width:500px; background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
        input,textarea { width:100%; padding:10px; margin-top:8px; border-radius:6px; border:1px solid #ccc; }
        textarea { height:100px; }
        button { width:100%; padding:12px; background:#8e44ad; color:white; border:none; border-radius:6px; margin-top:15px; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h2>Editar Nota</h2>

    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" value="{{ $nota->titulo }}" required>

        <label>Contenido</label>
        <textarea name="contenido" required>{{ $nota->contenido }}</textarea>

        <button type="submit">Guardar cambios</button>
    </form>

</div>

</body>
</html>
