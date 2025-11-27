<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>

    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; display:flex; justify-content:center; }
        .container { width:800px; background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th,td { border-bottom:1px solid #ccc; padding:10px; text-align:left; }
        .btn { padding:6px 10px; border-radius:5px; text-decoration:none; color:white; cursor:pointer; }
        .editar { background:#f1c40f; }
        .eliminar { background:#c0392b; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Calendario de Eventos</h1>

    {{-- FORMULARIO --}}
    <form action="{{ route('eventos.store') }}" method="POST">
        @csrf

        <input type="text" name="titulo" placeholder="Título del evento" required>
        <input type="date" name="fecha" required>
        <textarea name="descripcion" placeholder="Descripción" required
        style="width:100%; height:60px; margin-top:8px;"></textarea>

        <button style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px; margin-top:10px;">
            Agregar Evento
        </button>
    </form>

    {{-- LISTA --}}
    <table>
        <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>

        @foreach ($eventos as $e)
        <tr>
            <td>{{ $e->titulo }}</td>
            <td>{{ $e->fecha }}</td>
            <td>{{ $e->descripcion }}</td>
            <td>
                <a href="{{ route('eventos.edit', $e->id) }}" class="btn editar">Editar</a>

                <form action="{{ route('eventos.destroy', $e->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn eliminar" onclick="return confirm('¿Eliminar evento?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>

</body>
</html>

