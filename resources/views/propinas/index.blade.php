<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Propinas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            width: 450px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            margin-top: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        button:hover {
            background: #219150;
        }

        .resultado {
            margin-top: 20px;
            background: #ecf9f1;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #c6e9d3;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Calculadora de Propinas</h1>

    <form action="{{ route('propinas.calcular') }}" method="POST">
        @csrf

        <label>Monto</label>
        <input type="number" name="monto" step="0.01" required>

        <label>Porcentaje (%)</label>
        <input type="number" name="porcentaje" step="1" required>

        <button type="submit">Calcular</button>
    </form>

    @isset($total)
        <div class="resultado">
            <p><strong>Propina:</strong> ${{ number_format($propina, 2) }}</p>
            <p><strong>Total a pagar:</strong> ${{ number_format($total, 2) }}</p>
        </div>
    @endisset

</div>

</body>
</html>
