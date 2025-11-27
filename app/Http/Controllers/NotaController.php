<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotaController extends Controller
{
    private $archivo = 'notas.json';

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
        $notas = $this->cargar();
        return view('notas.index', compact('notas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria' => 'required|string'
        ]);

        $notas = $this->cargar();

        $notas[] = (object)[
            'id' => time(),
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'categoria' => $request->categoria,
            'fecha' => date('Y-m-d')
        ];

        $this->guardar($notas);

        return redirect()->route('notas.index');
    }

    public function destroy($id)
    {
        $notas = $this->cargar();

        $notas = array_filter($notas, function ($n) use ($id) {
            return $n->id != $id;
        });

        $this->guardar($notas);

        return redirect()->route('notas.index');
    }
}
