<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>

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

    <h2>Editar Evento</h2>

    <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" value="{{ $evento->titulo }}" required>

        <label>Fecha</label>
        <input type="date" name="fecha" value="{{ $evento->fecha }}" required>

        <label>Descripción</label>
        <textarea name="descripcion" required>{{ $evento->descripcion }}</textarea>

        <button type="submit">Guardar cambios</button>
    </form>

</div>

</body>
</html>
