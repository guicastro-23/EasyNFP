<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NuvemFiscal\Configuration;
use GuzzleHttp\Client;

class NuvemFiscalServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('nuvemfiscal.config', function () {
            $config = Configuration::getDefaultConfiguration();
            
            // Configura o token de acesso (será atualizado dinamicamente)
            $config->setAccessToken(app('nuvemfiscal.token')->getAccessToken());
            
            // Outras configurações
            $config->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_STRING);
            
            return $config;
        });

        $this->app->singleton('nuvemfiscal.token', function () {
            return new class() {
                public function getAccessToken()
                {
                    // Implementação temporária - vamos melhorar abaixo
                    return $this->requestNewToken();
                }

                protected function requestNewToken()
                {
                    $client = new Client();
                    $response = $client->post('https://auth.nuvemfiscal.com.br/oauth/token', [
                        'form_params' => [
                            'grant_type' => 'client_credentials',
                            'scope' => env('NUVEMFISCAL_SCOPE', 'cep cnpj'),
                        ],
                        'headers' => [
                            'Authorization' => 'Basic ' . base64_encode(
                                env('NUVEMFISCAL_CLIENTID') . ':' . env('NUVEMFISCAL_CLIENTSECRET')
                            ),
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                    ]);

                    return json_decode($response->getBody())->access_token;
                }
            };
        });
    }
}