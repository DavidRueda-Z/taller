<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropinaController extends Controller
{
    public function index()
    {
        return view('propinas.index', [
            'total' => null,
            'propina' => null,
            'porcentaje' => null
        ]);
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'porcentaje' => 'required|numeric|min:0'
        ]);

        $monto = $request->monto;
        $porcentaje = $request->porcentaje;

        $propina = $monto * ($porcentaje / 100);
        $total = $monto + $propina;

        return view('propinas.index', compact('monto', 'porcentaje', 'propina', 'total'));
    }
}

