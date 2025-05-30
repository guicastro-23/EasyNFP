<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use NuvemFiscal\Api\CepApi;
use NuvemFiscal\Configuration;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;


class NuvemFiscalService
{
    protected $clientId;
    protected $clientSecret;
    protected $tokenUrl = 'https://auth.nuvemfiscal.com.br/oauth/token';
    protected $baseUrl;

    public function __construct($ambiente = 'homologacao') // padrão: homologação
    {
        $config = config("services.nuvemfiscal.$ambiente");

        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->baseUrl = $config['base_url'];
    }

    public function cadastrarEmpresa($empresa, $endereco)
    {
        try {
            $token = $this->getOauthToken();

            $client = new Client();

            $response = $client->post("{$this->baseUrl}/empresas", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token->access_token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'cpf_cnpj' => preg_replace('/\D/', '', $empresa->cpf_cnpj),
                    'nome_razao_social' => $empresa->nome_razao_social,
                    'nome_fantasia' => $empresa->nome_fantasia,
                    'email' => $empresa->email,
                    'fone' => $empresa->fone,
                    'inscricao_estadual' => $empresa->inscricao_estadual,
                    'inscricao_municipal' => $empresa->inscricao_municipal,
                    'endereco' => [
                        'logradouro' => $endereco->logradouro,
                        'numero' => $endereco->numero,
                        'complemento' => $endereco->complemento,
                        'bairro' => $endereco->bairro,
                        'cidade' => $endereco->cidade,
                        'codigo_municipio' => $endereco->codigo_municipio,
                        'uf' => strtoupper($endereco->uf),
                        'cep' => preg_replace('/\D/', '', $endereco->cep),
                        'codigo_pais' => $endereco->codigo_pais,
                        'pais' => $endereco->pais,
                    ],
                ]
            ]);

            if (!in_array($response->getStatusCode(), [200, 201])) {
                throw new Exception("Erro ao cadastrar empresa na Nuvem Fiscal. Código HTTP: " . $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents());

        } catch (RequestException $e) {
            $statusCode = $e->getResponse() ? $e->getResponse()->getStatusCode() : 'Sem resposta';
            $errorBody = $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'Sem detalhes';

            Log::error("Erro HTTP ao chamar a Nuvem Fiscal. Código: $statusCode - Detalhes: $errorBody");
            throw new Exception("Erro HTTP ao cadastrar empresa na Nuvem Fiscal.");
        } catch (Exception $e) {
            Log::error("Erro geral ao cadastrar empresa na Nuvem Fiscal: " . $e->getMessage());
            throw new Exception("Erro geral ao cadastrar empresa na Nuvem Fiscal.");
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
                'scope' => 'empresa nfe cep cnpj',
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}


    
    // public function consultarCep(string $cep)
    // {
    //     try {
    //         // Obter token
    //         $token = $this->getOauthToken();

    //         // Configurar o token de acesso
    //         $config = Configuration::getDefaultConfiguration()->setAccessToken($token->access_token);
    //         $config->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_STRING);

    //         // Instanciar API
    //         $apiInstance = new CepApi(new Client(), $config);

    //         // Chamar a API
    //         return $apiInstance->consultarCep($cep);
    //     } catch (Exception $e) {
    //         throw new Exception("Erro ao consultar o CEP: " . $e->getMessage());
    //     }
    // }


