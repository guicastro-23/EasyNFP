<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use NuvemFiscal\Api\CepApi;
use NuvemFiscal\Configuration;

class NuvemFiscalService
{
    protected $clientId;
    protected $clientSecret;
    protected $tokenUrl = 'https://auth.nuvemfiscal.com.br/oauth/token';

    public function __construct()
    {
        $this->clientId = config('services.nuvemfiscal.client_id');
        $this->clientSecret = config('services.nuvemfiscal.client_secret');
    }

    public function consultarCep(string $cep)
    {
        try {
            // Obter token
            $token = $this->getOauthToken();

            // Configurar o token de acesso
            $config = Configuration::getDefaultConfiguration()->setAccessToken($token->access_token);
            $config->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_STRING);

            // Instanciar API
            $apiInstance = new CepApi(new Client(), $config);

            // Chamar a API
            return $apiInstance->consultarCep($cep);

        } catch (Exception $e) {
            throw new Exception("Erro ao consultar o CEP: " . $e->getMessage());
        }
    }

    private function getOauthToken()
    {
        $client = new Client();

        $response = $client->post($this->tokenUrl, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'cep cnpj',
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
