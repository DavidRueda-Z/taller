<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas</title>

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
            background: #8e44ad;
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
            background: #732d91;
        }

        .resultado {
            margin-top: 20px;
            background: #f7ecfc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e6d0f3;
            text-align: center;
        }

        .password-box {
            font-size: 1.3rem;
            font-weight: bold;
            color: #5a2d82;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Generador de Contraseñas</h1>

    <form action="{{ route('contrasenas.generar') }}" method="POST">
        @csrf

        <label>Longitud de la contraseña</label>
        <input type="number" name="longitud" min="4" max="50" required>

        <button type="submit">Generar</button>
    </form>

    @if ($contrasena)
        <div class="resultado">
            <p><strong>Contraseña generada:</strong></p>
            <div class="password-box">{{ $contrasena }}</div>
        </div>
    @endif

</div>

</body>
</html>
