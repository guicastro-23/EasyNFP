<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EnderecoEmitente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\NuvemFiscalService;
use Exception;

class EmpresaController extends Controller
{
    protected $nuvemFiscalService;

    public function __construct(NuvemFiscalService $nuvemFiscalService)
    {
        $this->nuvemFiscalService = $nuvemFiscalService;
    }

    public function create(): Response
    {
        return Inertia::render('Empresa/EmpresaForm');
    }
   
    public function store(Request $request)
    {
        $rules = [
            'tipo_pessoa' => 'required|in:cnpj,cpf',
            'email' => 'required|email',
            'fone' => 'nullable|string|max:20',
            'numero' => 'nullable|string|max:10',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|size:2',
            'complemento' => 'nullable|string|max:500',
            'pais' => 'nullable|string|max:255|',
            'codigo_municipio' => 'required|string|max:20',
            'codigo_pais' => 'nullable|string|max:10|',

            // Campos condicionais
            'cnpj' => 'required_if:tipo_pessoa,cnpj|nullable|string|size:14',
            'razao_social' => 'required_if:tipo_pessoa,cnpj|nullable|string|max:500',
            'nome_fantasia' => 'nullable|string|max:500',
            'cpf' => 'required_if:tipo_pessoa,cpf|nullable|string|size:11',
            'nome' => 'required_if:tipo_pessoa,cpf|nullable|string|max:500',
            'inscricao_estadual' => 'nullable|string|max:50',
            'inscricao_municipal' => 'nullable|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Cria a empresa
            $empresa = Empresa::create([
                'tipo_pessoa' => $request->tipo_pessoa,
                'cpf_cnpj' => $request->tipo_pessoa === 'cnpj' ? $request->cnpj : $request->cpf,
                'nome_razao_social' => $request->tipo_pessoa === 'cnpj' ? $request->razao_social : $request->nome,
                'nome_fantasia' => $request->nome_fantasia,
                'inscricao_estadual' => $request->inscricao_estadual,
                'inscricao_municipal' => $request->inscricao_municipal,
                'fone' => $request->fone,
                'email' => $request->email,
            ]);

            $pais = $request->pais ?? 'Brasil';
            $codigo_pais = $request->codigo_pais ?? '1058';

            // Cria o endereço
            $endereco = $empresa->endereco()->create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'cep' => $request->cep,
                'pais' => $pais,
                'codigo_municipio' => $request->codigo_municipio,
                'codigo_pais' => $codigo_pais,
            ]);

            Log::info('Endereço criado:', $endereco->toArray());
            
            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', 'Empresa cadastrada com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao cadastrar empresa: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar empresa. Por favor, tente novamente.')
                ->withInput();
        }
    }
}