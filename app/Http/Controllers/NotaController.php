<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index(): Response
    {
        $notas = collect([
            [
                'id' => 1,
                'numero' => 123,
                'tipo' => 'NFP',
                'status' => 'Autorizada',
                'valor_total' => 1500.00,
            ],
        ]);

        return Inertia::render('Nota/Index', [
            'notas' => $notas,
            ]);

        // $notas = Nota::get();
        // return Inertia::render('Nota/Index', [
        //     'notas' => $notas,
        // ]);
    }
}
