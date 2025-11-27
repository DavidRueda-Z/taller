<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservaController extends Controller
{
    private $archivo = 'reservas.json';

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
        $reservas = $this->cargar();
        return view('reservas.index', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'servicio' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required'
        ]);

        $reservas = $this->cargar();

        $reservas[] = (object)[
            'id' => time(),
            'nombre' => $request->nombre,
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora
        ];

        $this->guardar($reservas);

        return redirect()->route('reservas.index');
    }

    public function destroy($id)
    {
        $reservas = $this->cargar();

        $reservas = array_filter($reservas, function ($r) use ($id) {
            return $r->id != $id;
        });

        $this->guardar($reservas);

        return redirect()->route('reservas.index');
    }
}
