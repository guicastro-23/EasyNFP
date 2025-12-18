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
        $notas = Nota::get();
        return Inertia::render('Nota/Index', [
            'notas' => $notas,
        ]);
    }
}
