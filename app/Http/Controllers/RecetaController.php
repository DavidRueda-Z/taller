<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    private $archivo = 'recetas.json';

    private function cargar()
    {
        if (!Storage::exists($this->archivo)) {
            Storage::put($this->archivo, json_encode([]));
        }

        return json_decode(Storage::get($this->archivo));
    }

    private function guardar($lista)
    {
        Storage::put($this->archivo, json_encode($lista, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $recetas = $this->cargar();
        return view('recetas.index', compact('recetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string',
            'ingredientes' => 'required|string',
            'preparacion' => 'required|string',
        ]);

        $recetas = $this->cargar();

        $recetas[] = (object)[
            'id' => time(),
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'ingredientes' => $request->ingredientes,
            'preparacion' => $request->preparacion,
        ];

        $this->guardar($recetas);

        return redirect()->route('recetas.index');
    }

    public function destroy($id)
    {
        $recetas = $this->cargar();

        $recetas = array_filter($recetas, function ($r) use ($id) {
            return $r->id != $id;
        });

        $this->guardar($recetas);

        return redirect()->route('recetas.index');
    }

    public function edit($id)
{
    $recetas = $this->cargar();
    $receta = collect($recetas)->firstWhere('id', $id);

    return view('recetas.edit', compact('receta'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'categoria' => 'required|string',
        'ingredientes' => 'required|string',
        'preparacion' => 'required|string',
    ]);

    $recetas = $this->cargar();

    foreach ($recetas as $r) {
        if ($r->id == $id) {
            $r->titulo = $request->titulo;
            $r->categoria = $request->categoria;
            $r->ingredientes = $request->ingredientes;
            $r->preparacion = $request->preparacion;
        }
    }

    $this->guardar($recetas);

    return redirect()->route('recetas.index');
}

}
