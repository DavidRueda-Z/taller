<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GastoController extends Controller
{
    private $archivo = 'gastos.json';

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
        $gastos = $this->cargar();
        return view('gastos.index', compact('gastos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required|string',
        ]);

        $gastos = $this->cargar();

        $gastos[] = (object) [
            'id' => time(),
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'categoria' => $request->categoria,
            'fecha' => date('Y-m-d'),
        ];

        $this->guardar($gastos);

        return redirect()->route('gastos.index');
    }

    public function destroy($id)
    {
        $gastos = $this->cargar();

        $gastos = array_filter($gastos, function ($g) use ($id) {
            return $g->id != $id;
        });

        $this->guardar($gastos);

        return redirect()->route('gastos.index');
    }
}
