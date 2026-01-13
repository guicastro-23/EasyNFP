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
        return Inertia::render('Natureza/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Natureza/Create');
    }

}
