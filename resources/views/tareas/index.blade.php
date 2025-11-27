<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
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

        .acciones {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
        }

        .btn-editar { background: #f1c40f; }
        .btn-marcar { background: #27ae60; }
        .btn-eliminar { background: #c0392b; }
    </style>
</head>
<body>

<div class="container">

    @include('partials.volver')

    <h1>Lista de Tareas</h1>

    {{-- FORM AGREGAR --}}
    <form method="POST" action="{{ route('tareas.store') }}">
        @csrf
        <input type="text" name="texto" placeholder="Nueva tarea..." required
        style="width:75%; padding:10px; border:1px solid #ccc; border-radius:6px;">

        <button type="submit"
        style="padding:10px 15px; background:#8e44ad; color:white; border:none; border-radius:6px;">
            Agregar
        </button>
    </form>

    <hr><br>

    {{-- LISTADO --}}
    <ul style="list-style:none; padding:0;">
        @foreach ($tareas as $t)

            @php
                $hecha = property_exists($t, 'hecha') ? $t->hecha : false;
            @endphp

            <li style="margin-bottom:12px; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #eee; padding:8px 5px;">

                <span style="{{ $hecha ? 'text-decoration: line-through; color:gray;' : '' }}">
                    • {{ $t->texto }}
                </span>

                <div class="acciones">

                    @if (!$hecha)
                        <a href="{{ route('tareas.edit', $t->id) }}" class="btn btn-editar">Editar</a>

                        <form action="{{ route('tareas.marcar', $t->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-marcar">Marcar</button>
                        </form>

                    @else
                        <form action="{{ route('tareas.destroy', $t->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-eliminar"
                            onclick="return confirm('¿Eliminar tarea completada?')">
                                Eliminar
                            </button>
                        </form>
                    @endif

                </div>

            </li>

        @endforeach
    </ul>

</div>

</body>
</html>

