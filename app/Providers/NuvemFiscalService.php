<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use NuvemFiscal\Api\CepApi;
use NuvemFiscal\Configuration;

class NuvemFiscalService
{
    protected $guzzleClient;
    protected $config;

    public function __construct()
    {
        $handlerStack = HandlerStack::create(new CurlHandler());
        $this->guzzleClient = new Client(['handler' => $handlerStack]);

        $this->config = Configuration::getDefaultConfiguration();
        $this->config->setAccessToken($this->obterToken());
        $this->config->setHost('https://api.nuvemfiscal.com.br');
        $this->config->setDebug(false);
    }

    private function obterToken(): string
    {
        $response = Http::withOptions([
                'handler' => HandlerStack::create(new CurlHandler())
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

        if ($response->failed()) {
            throw new \Exception('Erro ao obter token: ' . $response->body());
        }

        return $response->json()['access_token'];
    }

    public function consultarCep(string $cep): array
    {
        $cepApi = new CepApi($this->guzzleClient, $this->config);
        $result = $cepApi->consultarCep($cep);
        return $result;
    }
}
