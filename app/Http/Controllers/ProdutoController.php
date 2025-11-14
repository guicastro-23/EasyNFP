<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): Response 
    {
        return Inertia::render('Produto/Index', [
            
        ]);
    }
}
