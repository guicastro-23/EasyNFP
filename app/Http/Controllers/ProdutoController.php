<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): Response 
    {
        $produtos = Produto::get();
        return Inertia::render('Produto/Index', [
            'produtos' => $produtos,
        ]);
    }
}
