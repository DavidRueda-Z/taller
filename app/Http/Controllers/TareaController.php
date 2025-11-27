<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TareaController extends Controller
{
    private $archivo = 'tareas.json';

    private function cargarTareas()
    {
        if (!Storage::exists($this->archivo)) {
            Storage::put($this->archivo, json_encode([]));
        }

        return json_decode(Storage::get($this->archivo));
    }

    private function guardarTareas($tareas)
    {
        Storage::put($this->archivo, json_encode($tareas, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $tareas = $this->cargarTareas();
        return view('tareas.index', compact('tareas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tarea' => 'required|string|max:255'
        ]);

        $tareas = $this->cargarTareas();

        $tareas[] = (object) [
            'id' => time(),
            'texto' => $request->tarea,
        ];

        $this->guardarTareas($tareas);

        return redirect()->route('tareas.index');
    }

    public function destroy($id)
    {
        $tareas = $this->cargarTareas();

        $tareas = array_filter($tareas, function ($t) use ($id) {
            return $t->id != $id;
        });

        $this->guardarTareas($tareas);

        return redirect()->route('tareas.index');
    }
}

