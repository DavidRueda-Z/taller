<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotaController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/notas.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        return json_decode(file_get_contents($ruta));
    }

    private function guardar($notas)
    {
        $ruta = storage_path('app/notas.json');
        file_put_contents($ruta, json_encode($notas, JSON_PRETTY_PRINT));
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
        ]);

        $notas = $this->cargar();

        $notas[] = (object)[
            'id' => time(),
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
        ];

        $this->guardar($notas);

        return redirect()->route('notas.index');
    }

    public function destroy($id)
    {
        $notas = $this->cargar();

        $notas = array_filter($notas, fn($n) => $n->id != $id);
        $notas = array_values($notas);

        $this->guardar($notas);

        return redirect()->route('notas.index');
    }

    public function edit($id)
    {
        $notas = $this->cargar();
        $nota = collect($notas)->firstWhere('id', $id);

        if (!$nota) {
            abort(404, "Nota no encontrada");
        }

        return view('notas.edit', compact('nota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        $notas = $this->cargar();

        foreach ($notas as $n) {
            if ($n->id == $id) {
                $n->titulo = $request->titulo;
                $n->contenido = $request->contenido;
            }
        }

        $this->guardar($notas);

        return redirect()->route('notas.index');
    }
}
