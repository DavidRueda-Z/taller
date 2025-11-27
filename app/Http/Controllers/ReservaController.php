<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/reservas.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        return json_decode(file_get_contents($ruta));
    }

    private function guardar($reservas)
    {
        $ruta = storage_path('app/reservas.json');
        file_put_contents($ruta, json_encode($reservas, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $reservas = $this->cargar();
        return view('reservas.index', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'personas' => 'required|numeric|min:1',
        ]);

        $reservas = $this->cargar();

        $reservas[] = (object)[
            'id' => time(),
            'cliente' => $request->cliente,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'personas' => $request->personas,
        ];

        $this->guardar($reservas);

        return redirect()->route('reservas.index');
    }

    public function destroy($id)
    {
        $reservas = $this->cargar();

        $reservas = array_filter($reservas, fn($r) => $r->id != $id);
        $reservas = array_values($reservas);

        $this->guardar($reservas);

        return redirect()->route('reservas.index');
    }

    public function edit($id)
    {
        $reservas = $this->cargar();
        $reserva = collect($reservas)->firstWhere('id', $id);

        if (!$reserva) {
            abort(404, "Reserva no encontrada");
        }

        return view('reservas.edit', compact('reserva'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'personas' => 'required|numeric|min:1',
        ]);

        $reservas = $this->cargar();

        foreach ($reservas as $r) {
            if ($r->id == $id) {
                $r->cliente = $request->cliente;
                $r->fecha = $request->fecha;
                $r->hora = $request->hora;
                $r->personas = $request->personas;
            }
        }

        $this->guardar($reservas);

        return redirect()->route('reservas.index');
    }
}

