<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    private function cargar()
    {
        $ruta = storage_path('app/encuestas.json');

        if (!file_exists($ruta)) {
            file_put_contents($ruta, json_encode([]));
        }

        $encuestas = json_decode(file_get_contents($ruta));

        // Asegurar compatibilidad con encuestas antiguas (sin "votos")
        foreach ($encuestas as $encuesta) {
            foreach ($encuesta->opciones as $i => $op) {
                if (!property_exists($op, 'votos')) {
                    // Si opciones vienen como texto → convertirlas a objetos
                    if (is_string($op)) {
                        $encuesta->opciones[$i] = (object)[
                            'texto' => $op,
                            'votos' => 0
                        ];
                    } else {
                        $encuesta->opciones[$i]->votos = 0;
                    }
                }
            }
        }

        return $encuestas;
    }

    private function guardar($encuestas)
    {
        $ruta = storage_path('app/encuestas.json');
        file_put_contents($ruta, json_encode($encuestas, JSON_PRETTY_PRINT));
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

        // Convertir opciones a objetos con votos iniciales
        $opciones = array_map(function ($op) {
            return (object)[
                'texto' => trim($op),
                'votos' => 0
            ];
        }, explode("\n", trim($request->opciones)));

        $encuestas[] = (object)[
            'id' => time(),
            'pregunta' => $request->pregunta,
            'opciones' => $opciones
        ];

        $this->guardar($encuestas);

        return redirect()->route('encuestas.index');
    }

    public function votar($id, $opcion)
    {
        $encuestas = $this->cargar();

        foreach ($encuestas as $encuesta) {
            if ($encuesta->id == $id) {

                // Asegurar formato correcto
                foreach ($encuesta->opciones as $i => $op) {
                    if (!property_exists($op, 'votos')) {
                        $encuesta->opciones[$i]->votos = 0;
                    }
                }

                // Registrar voto si la opción existe
                if (isset($encuesta->opciones[$opcion])) {
                    $encuesta->opciones[$opcion]->votos++;
                }
            }
        }

        $this->guardar($encuestas);

        return redirect()->route('encuestas.index');
    }

    public function destroy($id)
    {
        $encuestas = $this->cargar();

        $encuestas = array_filter($encuestas, fn($e) => $e->id != $id);
        $encuestas = array_values($encuestas);

        $this->guardar($encuestas);

        return redirect()->route('encuestas.index');
    }
}

