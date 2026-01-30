<?php

namespace Matfatjoe\BradescoBoleto\Boleto;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Matfatjoe\BradescoBoleto\Models\Token;

/**
 * Serviço para gerenciamento de Boletos do Bradesco
 */
class BoletoService
{
    private $client;
    private $token;
    private $baseUrl;

    public function __construct(Client $client, Token $token, string $baseUrl = 'https://openapisandbox.prebanco.com.br')
    {
        $this->client = $client;
        $this->token = $token;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Registra um novo boleto
     *
     * @param RegisterBoletoBradescoRequest $request
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function register(RegisterBoletoBradescoRequest $request): array
    {
        try {
            $response = $this->client->request('POST', $this->baseUrl . '/boleto-hibrido/cobranca-registro/v1/gerarBoleto', [
                'headers' => [
                    'Authorization' => $this->token->getAuthorizationHeader(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $request->toArray()
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            if ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 201) {
                throw new \Exception('Failed to register boleto. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
            }

            return $data;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            throw new \Exception('Failed to register boleto. ' . $responseBody);
        }
    }

    /**
     * Altera um boleto existente
     *
     * @param array $dadosAlteracao Dados para alteração do boleto
     * @param string|null $txId Transaction ID (opcional, pode ser enviado no header)
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function alterar(array $dadosAlteracao, ?string $txId = null): array
    {
        $headers = [
            'Authorization' => $this->token->getAuthorizationHeader(),
            'Content-Type' => 'application/json'
        ];

        if ($txId !== null) {
            $headers['txId'] = $txId;
        }

        $response = $this->client->request('POST', $this->baseUrl . '/boleto-hibrido/cobranca-alteracao/v1/alteraBoletoConsulta', [
            'headers' => $headers,
            'json' => $dadosAlteracao
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to alter boleto. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }

    /**
     * Solicita baixa de um boleto
     *
     * @param array $dadosBaixa Dados para baixa do boleto
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function baixar(array $dadosBaixa): array
    {
        $response = $this->client->request('POST', $this->baseUrl . '/boleto/cobranca-baixa/v1/baixar', [
            'headers' => [
                'Authorization' => $this->token->getAuthorizationHeader(),
                'Content-Type' => 'application/json'
            ],
            'json' => $dadosBaixa
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to cancel boleto. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }
}
