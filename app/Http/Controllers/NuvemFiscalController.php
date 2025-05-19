<?php

namespace App\Http\Controllers;

use App\Services\NuvemFiscalService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class NuvemFiscalController extends Controller
{
    protected $nuvemFiscal;

    public function __construct(NuvemFiscalService $nuvemFiscal)
    {
        $this->nuvemFiscal = $nuvemFiscal;
    }

    public function testarCep()
    {
        try {
            $result = $this->nuvemFiscal->consultarCep('84172236');
            return response()->json($result);

        } catch (\NuvemFiscal\ApiException $e) {
            Log::error('Erro na API Nuvem Fiscal', [
                'message' => $e->getMessage(),
                'response' => $e->getResponseBody()
            ]);
            return response()->json([
                'error' => 'Erro na API Nuvem Fiscal',
                'details' => json_decode($e->getResponseBody(), true)
            ], $e->getCode());

        } catch (\Exception $e) {
            Log::error('Erro geral', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Erro inesperado',
                'message' => $e->getMessage(),
                'trace' => env('APP_DEBUG') ? $e->getTrace() : null
            ], 500);
        }
    }
}
