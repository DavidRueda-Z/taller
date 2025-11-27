<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Gastos</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 550px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
        }

        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        button {
            background: #27ae60;
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
            background: #1e8a4c;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        a.eliminar {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        a.eliminar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Gestor de Gastos</h1>

    <form method="POST" action="{{ route('gastos.store') }}">
        @csrf

        <label>Descripción</label>
        <input type="text" name="descripcion" required>

        <label>Monto</label>
        <input type="number" name="monto" step="0.01" required>

        <label>Categoría</label>
        <select name="categoria" required>
            <option value="Comida">Comida</option>
            <option value="Transporte">Transporte</option>
            <option value="Servicios">Servicios</option>
            <option value="Compras">Compras</option>
            <option value="Otros">Otros</option>
        </select>

        <button type="submit">Agregar Gasto</button>
    </form>

    <table>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Categoría</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        @forelse ($gastos as $g)
            <tr>
                <td>{{ $g->descripcion }}</td>
                <td>${{ number_format($g->monto, 2) }}</td>
                <td>{{ $g->categoria }}</td>
                <td>{{ $g->fecha }}</td>
                <td>
                    <a class="eliminar"
                       href="{{ route('gastos.destroy', $g->id) }}"
                       onclick="return confirm('¿Eliminar este gasto?')">
                       Eliminar
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" style="text-align:center;">No hay gastos</td></tr>
        @endforelse
    </table>

</div>

</body>
</html>
