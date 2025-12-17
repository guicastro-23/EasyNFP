<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    public function index(): Response 
    {
        $produtos = Produto::get();
        return Inertia::render('Produto/Index', [
            'produtos' => $produtos,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Produto/Create');
    }

    public function store(ProdutoRequest $request)
    {
        Produto::create($request->validated());

        return redirect()
            ->route('produto.index')
            ->with('success', 'Produto criando com sucesso!');
    } 
}
