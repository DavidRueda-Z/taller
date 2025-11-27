<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/eventos.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        return json_decode(file_get_contents($ruta));
    }

    private function guardar($eventos)
    {
        $ruta = storage_path('app/eventos.json');
        file_put_contents($ruta, json_encode($eventos, JSON_PRETTY_PRINT));
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
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        $eventos = $this->cargar();

        $eventos[] = (object)[
            'id' => time(),
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
        ];

        $this->guardar($eventos);

        return redirect()->route('eventos.index');
    }

    public function destroy($id)
    {
        $eventos = $this->cargar();

        $eventos = array_filter($eventos, fn($e) => $e->id != $id);
        $eventos = array_values($eventos);

        $this->guardar($eventos);

        return redirect()->route('eventos.index');
    }

    public function edit($id)
    {
        $eventos = $this->cargar();
        $evento = collect($eventos)->firstWhere('id', $id);

        if (!$evento) {
            abort(404, "Evento no encontrado");
        }

        return view('calendario.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        $eventos = $this->cargar();

        foreach ($eventos as $e) {
            if ($e->id == $id) {
                $e->titulo = $request->titulo;
                $e->fecha = $request->fecha;
                $e->descripcion = $request->descripcion;
            }
        }

        $this->guardar($eventos);

        return redirect()->route('calendario.index');
    }
}

