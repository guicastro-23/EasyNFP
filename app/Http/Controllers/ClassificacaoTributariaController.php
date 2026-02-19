<?php

namespace App\Http\Controllers;

use App\Models\ClassificacaoTributaria;
use Illuminate\Http\Request;

class ClassificacaoTributariaController extends Controller
{
    public function index()
    {   
        $classificacoes = ClassificacaoTributaria::with([
            'cstIcms'
        ])->get();
        return inertia('Classificacoes/Index', [
            'classificacoes' => $classificacoes
        ]);
    }
}
