<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GastoController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/gastos.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        return json_decode(file_get_contents($ruta));
    }

    private function guardar($gastos)
    {
        $ruta = storage_path('app/gastos.json');
        file_put_contents($ruta, json_encode($gastos, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $gastos = $this->cargar();

        // calcular total
        $total = 0;
        foreach ($gastos as $g) {
            $total += $g->monto;
        }

        return view('gastos.index', compact('gastos', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required',
            'fecha' => 'required|date'
        ]);

        $gastos = $this->cargar();

        $gastos[] = (object)[
            'id' => time(),
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'categoria' => $request->categoria,
            'fecha' => $request->fecha,
        ];

        $this->guardar($gastos);

        return redirect()->route('gastos.index');
    }

    public function destroy($id)
    {
        $gastos = $this->cargar();

        $gastos = array_filter($gastos, fn($g) => $g->id != $id);
        $gastos = array_values($gastos);

        $this->guardar($gastos);

        return redirect()->route('gastos.index');
    }

    public function edit($id)
    {
        $gastos = $this->cargar();
        $gasto = collect($gastos)->firstWhere('id', $id);

        if (!$gasto) {
            abort(404, "Gasto no encontrado");
        }

        return view('gastos.edit', compact('gasto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required',
            'fecha' => 'required|date'
        ]);

        $gastos = $this->cargar();

        foreach ($gastos as $g) {
            if ($g->id == $id) {
                $g->descripcion = $request->descripcion;
                $g->monto = $request->monto;
                $g->categoria = $request->categoria;
                $g->fecha = $request->fecha;
            }
        }

        $this->guardar($gastos);

        return redirect()->route('gastos.index');
    }
}

