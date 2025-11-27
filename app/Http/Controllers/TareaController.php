<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TareaController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/tareas.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        $tareas = json_decode(file_get_contents($ruta));

        // Asegurar que cada tarea tenga "hecha"
        foreach ($tareas as $t) {
            if (!property_exists($t, 'hecha')) {
                $t->hecha = false;
            }
        }

        return $tareas;
    }

    private function guardar($tareas)
    {
        $ruta = storage_path('app/tareas.json');
        file_put_contents($ruta, json_encode($tareas, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $tareas = $this->cargar();
        return view('tareas.index', compact('tareas'));
    }

    public function store(Request $request)
    {
        $request->validate(['texto' => 'required|string|max:255']);

        $tareas = $this->cargar();

        $tareas[] = (object)[
            'id' => time(),
            'texto' => $request->texto,
            'hecha' => false
        ];

        $this->guardar($tareas);

        return redirect()->route('tareas.index');
    }

    public function marcar($id)
    {
        $tareas = $this->cargar();

        foreach ($tareas as $t) {
            if ($t->id == $id) {
                $t->hecha = true;
            }
        }

        $this->guardar($tareas);

        return redirect()->route('tareas.index');
    }

    public function edit($id)
    {
        $tareas = $this->cargar();
        $tarea = collect($tareas)->firstWhere('id', $id);

        if (!$tarea) {
            abort(404, "Tarea no encontrada");
        }

        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['texto' => 'required|string|max:255']);

        $tareas = $this->cargar();

        foreach ($tareas as $t) {
            if ($t->id == $id) {
                $t->texto = $request->texto;
            }
        }

        $this->guardar($tareas);

        return redirect()->route('tareas.index');
    }

    public function destroy($id)
    {
        $tareas = $this->cargar();

        $tareas = array_filter($tareas, function($t) use ($id) {
            if ($t->id == $id && $t->hecha) {
                return false; // eliminar
            }
            return true; // mantener
        });

        $tareas = array_values($tareas);

        $this->guardar($tareas);

        return redirect()->route('tareas.index');
    }
}


