<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas</title>

    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; display:flex; justify-content:center; }
        .container { width:800px; background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th,td { border-bottom:1px solid #ccc; padding:10px; text-align:left; }
        .btn { padding:5px 10px; border-radius:5px; text-decoration:none; color:white; }
        .editar { background:#f1c40f; }
        .eliminar { background:#c0392b; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Sistema de Reservas</h1>

    {{-- FORMULARIO --}}
    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <input type="text" name="cliente" placeholder="Nombre del cliente" required>
        <input type="date" name="fecha" required>
        <input type="time" name="hora" required>
        <input type="number" name="personas" placeholder="N° personas" min="1" required>

        <button style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px;">
            Agregar
        </button>
    </form>

    {{-- LISTA --}}
    <table>
        <tr>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Acciones</th>
        </tr>

        @foreach ($reservas as $r)
        <tr>
            <td>{{ $r->cliente }}</td>
            <td>{{ $r->fecha }}</td>
            <td>{{ $r->hora }}</td>
            <td>{{ $r->personas }}</td>
            <td>
                <a href="{{ route('reservas.edit', $r->id) }}" class="btn editar">Editar</a>

                <form action="{{ route('reservas.destroy', $r->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn eliminar" onclick="return confirm('¿Eliminar reserva?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</div>

</body>
</html>
