<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EncuestaController extends Controller
{
    private $archivo = 'encuestas.json';

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
        $encuestas = $this->cargar();
        return view('encuestas.index', compact('encuestas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string|max:255',
            'opciones' => 'required|string',
        ]);

        $encuestas = $this->cargar();

        $encuestas[] = (object)[
            'id' => time(),
            'pregunta' => $request->pregunta,
            'opciones' => array_map('trim', explode("\n", $request->opciones)),
        ];

        $this->guardar($encuestas);

        return redirect()->route('encuestas.index');
    }

    public function destroy($id)
    {
        $encuestas = $this->cargar();

        $encuestas = array_filter($encuestas, function ($e) use ($id) {
            return $e->id != $id;
        });

        $this->guardar($encuestas);

        return redirect()->route('encuestas.index');
    }
}
