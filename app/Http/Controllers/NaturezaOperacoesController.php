<?php

namespace App\Http\Controllers;

use App\Models\NaturezaOperacao;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;

class NaturezaOperacoesController extends Controller
{
    public function index()
    {
        $naturezas = NaturezaOperacao::query()
            ->orderBy('created_at')
            ->get();

        return Inertia::render('Natureza/Index', [
            'naturezas' => $naturezas,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Natureza/Create');
    }

}
