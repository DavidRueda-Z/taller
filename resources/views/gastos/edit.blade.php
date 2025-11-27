<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Gasto</title>

    <style>
        body { font-family:Arial; background:#f4f4f4; padding:40px; display:flex; justify-content:center; }
        .container { width:500px; background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
        input { width:100%; padding:10px; margin-top:8px; border-radius:6px; border:1px solid #ccc; }
        button { width:100%; padding:12px; background:#8e44ad; color:white; border:none; border-radius:6px; margin-top:15px; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h2>Editar Gasto</h2>

    <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
        @csrf

        <label>Descripción</label>
        <input type="text" name="descripcion" value="{{ $gasto->descripcion }}" required>

        <label>Monto</label>
        <input type="number" step="0.01" name="monto" value="{{ $gasto->monto }}" required>

        <label>Categoría</label>
        <input type="text" name="categoria" value="{{ $gasto->categoria }}" required>

        <label>Fecha</label>
        <input type="date" name="fecha" value="{{ $gasto->fecha }}" required>

        <button type="submit">Guardar cambios</button>

    </form>

</div>

</body>
</html>
