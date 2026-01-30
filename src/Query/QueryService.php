<?php

namespace Matfatjoe\BradescoBoleto\Query;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Matfatjoe\BradescoBoleto\Models\Token;

/**
 * Serviço para consulta de Boletos do Bradesco
 */
class QueryService
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
     * Consulta boleto por nosso número
     *
     * @param array $dadosConsulta Dados para consulta do boleto
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function consultar(array $dadosConsulta): array
    {
        $response = $this->client->request(
            'POST',
            $this->baseUrl . '/boleto-hibrido/cobranca-consulta-titulo/v1/consultar',
            [
                'headers' => [
                    'Authorization' => $this->token->getAuthorizationHeader(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $dadosConsulta
            ]
        );

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to query boleto. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }

    /**
     * Lista boletos liquidados
     *
     * @param array $filtros Filtros para listagem
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function listar(array $filtros): array
    {
        $response = $this->client->request(
            'POST',
            $this->baseUrl . '/boleto-hibrido/cobranca-lista/v1/listar',
            [
                'headers' => [
                    'Authorization' => $this->token->getAuthorizationHeader(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $filtros
            ]
        );

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to list boletos. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }
}
