<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Reserva</title>

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

    <h2>Editar Reserva</h2>

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf

        <label>Cliente</label>
        <input type="text" name="cliente" value="{{ $reserva->cliente }}" required>

        <label>Fecha</label>
        <input type="date" name="fecha" value="{{ $reserva->fecha }}" required>

        <label>Hora</label>
        <input type="time" name="hora" value="{{ $reserva->hora }}" required>

        <label>N° Personas</label>
        <input type="number" name="personas" value="{{ $reserva->personas }}" min="1" required>

        <button type="submit">Guardar cambios</button>
    </form>

</div>

</body>
</html>
