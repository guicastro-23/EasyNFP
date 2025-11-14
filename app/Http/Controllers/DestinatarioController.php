<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class DestinatarioController extends Controller
{
    public function index(): Response
    {
        $destinatarios = Destinatario::with('endereco')->get();

        return Inertia::render('Destinatario/Index', [
            'destinatarios' => $destinatarios,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Destinatario/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => 'nullable|string|size:11',
            'cnpj' => 'nullable|string|size:14',
            'id_estrangeiro' => 'nullable|string|max:50',
            'xnome' => 'required|string|max:60',
            'ind_ie_dest' => 'required|in:1,2,9',
            'ie' => 'nullable|string|max:14',
            'isuf' => 'nullable|string|max:20',
            'im' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:60',

            // Endereço
            'endereco.xlgr' => 'required|string|max:60',
            'endereco.nro' => 'required|string|max:60',
            'endereco.xCpl' => 'nullable|string|max:60',
            'endereco.xBairro' => 'required|string|max:255',
            'endereco.cMun' => 'required|string|max:20',
            'endereco.xMun' => 'required|string|max:60',
            'endereco.UF' => 'required|string|size:2',
            'endereco.CEP' => 'required|string|max:20',
            'endereco.cPais' => 'nullable|string|max:10',
            'endereco.xPais' => 'nullable|string|max:60',
            'endereco.fone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {


            $endereco = Endereco::create([
                'tipo' => 'destinatario',
                'xlgr' => $request->input('endereco.xlgr'),
                'nro' => $request->input('endereco.nro'),
                'xCpl' => $request->input('endereco.xCpl'),
                'xBairro' => $request->input('endereco.xBairro'),
                'cMun' => $request->input('endereco.cMun'),
                'xMun' => $request->input('endereco.xMun'),
                'UF' => strtoupper($request->input('endereco.UF')),
                'CEP' => $request->input('endereco.CEP'),
                'cPais' => $request->input('endereco.cPais') ?? '1058',
                'xPais' => $request->input('endereco.xPais') ?? 'Brasil',
                'fone' => $request->input('endereco.fone'),
            ]);

            Destinatario::create([
                'cpf' => $request->cpf,
                'cnpj' => $request->cnpj,
                'id_estrangeiro' => $request->id_estrangeiro,
                'xnome' => $request->xnome,
                'endereco_id' => $endereco->id,
                'ind_ie_dest' => $request->ind_ie_dest,
                'ie' => $request->ie,
                'isuf' => $request->isuf,
                'im' => $request->im,
                'email' => $request->email,
            ]);

            DB::commit();

            return redirect()->route('destinatario.index')
                ->with('success', 'Destinatário cadastrado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar destinatário. ' . $e->getMessage())
                ->withInput();
        }
    }
}
