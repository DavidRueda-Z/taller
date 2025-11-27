<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 600px;
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
            background: #2980b9;
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
            background: #1f6797;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
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

    <h1>Sistema de Reservas</h1>

    <form method="POST" action="{{ route('reservas.store') }}">
        @csrf

        <label>Nombre del cliente</label>
        <input type="text" name="nombre" required>

        <label>Servicio</label>
        <select name="servicio" required>
            <option value="Consulta">Consulta</option>
            <option value="Corte de cabello">Corte de cabello</option>
            <option value="Sesión de masaje">Sesión de masaje</option>
            <option value="Revisión técnica">Revisión técnica</option>
        </select>

        <label>Fecha</label>
        <input type="date" name="fecha" required>

        <label>Hora</label>
        <input type="time" name="hora" required>

        <button type="submit">Registrar Reserva</button>
    </form>

    <table>
        <tr>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acciones</th>
        </tr>

        @forelse ($reservas as $r)
            <tr>
                <td>{{ $r->nombre }}</td>
                <td>{{ $r->servicio }}</td>
                <td>{{ $r->fecha }}</td>
                <td>{{ $r->hora }}</td>
                <td>
                    <a class="eliminar"
                       href="{{ route('reservas.destroy', $r->id) }}"
                       onclick="return confirm('¿Eliminar esta reserva?')">
                       Eliminar
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" style="text-align:center;">No hay reservas</td></tr>
        @endforelse
    </table>

</div>

</body>
</html>
