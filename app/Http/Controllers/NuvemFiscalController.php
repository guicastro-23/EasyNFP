<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

class NuvemFiscalController extends Controller
{
    public function testarCep()
    {
        try {
            // 1. Configurar um handler customizado para o Guzzle
            $handlerStack = HandlerStack::create(new CurlHandler());
            $guzzleClient = new Client(['handler' => $handlerStack]);

            // 2. Obter token com autenticação Basic Auth correta
            $tokenResponse = Http::withOptions([
                    'handler' => $handlerStack,
                ])
                ->withHeaders([
                    'Authorization' => 'Basic ' . base64_encode(env('NUVEMFISCAL_CLIENTID') . ':' . env('NUVEMFISCAL_CLIENTSECRET')),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ])
                ->asForm()
                ->post('https://auth.nuvemfiscal.com.br/oauth/token', [
                    'grant_type' => 'client_credentials',
                    'scope' => 'cep cnpj',
                ]);

            if ($tokenResponse->failed()) {
                throw new \Exception('Falha na autenticação: ' . $tokenResponse->body());
            }

            $token = $tokenResponse->json()['access_token'];

            // 3. Configurar o SDK com o client Guzzle customizado
            $config = \NuvemFiscal\Configuration::getDefaultConfiguration();
            $config->setAccessToken($token);
            $config->setHost('https://api.nuvemfiscal.com.br');
            
            // Desativar debug para evitar o erro de stream
            $config->setDebug(false);
            
            // 4. Instanciar a API com o client customizado
            $apiInstance = new \NuvemFiscal\Api\CepApi(
                $guzzleClient, // Usando o mesmo client customizado
                $config
            );

            // 5. Fazer a consulta
            $result = $apiInstance->consultarCep('80030030');
            
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