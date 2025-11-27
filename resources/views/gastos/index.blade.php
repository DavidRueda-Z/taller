<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Gastos</title>

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

    <h1>Gestor de Gastos</h1>

    {{-- FORMULARIO --}}
    <form action="{{ route('gastos.store') }}" method="POST">
        @csrf

        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" step="0.01" name="monto" placeholder="Monto" required>
        <input type="text" name="categoria" placeholder="Categoría" required>
        <input type="date" name="fecha" required>

        <button style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px;">
            Agregar
        </button>
    </form>

    {{-- LISTA --}}
    <table>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Categoría</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        @foreach ($gastos as $g)
        <tr>
            <td>{{ $g->descripcion }}</td>
            <td>${{ number_format($g->monto, 2) }}</td>
            <td>{{ $g->categoria }}</td>
            <td>{{ $g->fecha }}</td>
            <td>
                <a href="{{ route('gastos.edit', $g->id) }}" class="btn editar">Editar</a>

                <form action="{{ route('gastos.destroy', $g->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn eliminar" onclick="return confirm('¿Eliminar gasto?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    <h3>Total gastado: ${{ number_format($total, 2) }}</h3>

</div>

</body>
</html>
