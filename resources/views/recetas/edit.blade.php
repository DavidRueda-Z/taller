<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Receta</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
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

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }

        textarea {
            height: 80px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #8e44ad;
            color: white;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #70358d;
        }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Editar Receta</h1>

    <form action="{{ route('recetas.update', $receta->id) }}" method="POST">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" value="{{ $receta->titulo }}" required>

        <label>Categoría</label>
        <select name="categoria" required>
            <option {{ $receta->categoria == 'Postre' ? 'selected' : '' }}>Postre</option>
            <option {{ $receta->categoria == 'Plato fuerte' ? 'selected' : '' }}>Plato fuerte</option>
            <option {{ $receta->categoria == 'Bebida' ? 'selected' : '' }}>Bebida</option>
            <option {{ $receta->categoria == 'Entrada' ? 'selected' : '' }}>Entrada</option>
            <option {{ $receta->categoria == 'Ensalada' ? 'selected' : '' }}>Ensalada</option>
            <option {{ $receta->categoria == 'Otros' ? 'selected' : '' }}>Otros</option>
        </select>

        <label>Ingredientes</label>
        <textarea name="ingredientes" required>{{ $receta->ingredientes }}</textarea>

        <label>Preparación</label>
        <textarea name="preparacion" required>{{ $receta->preparacion }}</textarea>

        <button type="submit">Guardar Cambios</button>
    </form>

</div>

</body>
</html>
