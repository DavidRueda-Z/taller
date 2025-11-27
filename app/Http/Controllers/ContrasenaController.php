<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContrasenaController extends Controller
{
    public function index()
    {
        return view('contrasenas.index', [
            'contrasena' => null
        ]);
    }

    public function generar(Request $request)
    {
        $request->validate([
            'longitud' => 'required|numeric|min:4|max:50',
        ]);

        $longitud = $request->longitud;

        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';

        for ($i = 0; $i < $longitud; $i++) {
            $password .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        return view('contrasenas.index', [
            'contrasena' => $password
        ]);
    }
}
