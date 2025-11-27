<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    private $archivo = 'eventos.json';

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
        $eventos = $this->cargar();
        return view('calendario.index', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $eventos = $this->cargar();

        $eventos[] = (object)[
            'id' => time(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha
        ];

        $this->guardar($eventos);

        return redirect()->route('eventos.index');
    }

    public function destroy($id)
    {
        $eventos = $this->cargar();

        $eventos = array_filter($eventos, function ($e) use ($id) {
            return $e->id != $id;
        });

        $this->guardar($eventos);

        return redirect()->route('eventos.index');
    }
}
