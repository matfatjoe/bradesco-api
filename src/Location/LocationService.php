<?php

namespace Matfatjoe\BradescoBoleto\Location;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Matfatjoe\BradescoBoleto\Models\Token;

/**
 * Serviço para reserva de ID Location do Bradesco
 */
class LocationService
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
     * Reserva um ID Location
     *
     * @param array $dadosReserva Dados para reserva do location
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function reservar(array $dadosReserva): array
    {
        $response = $this->client->request('POST', $this->baseUrl . '/boleto-hibrido/cobranca-reserva-location/v1/reservarLoc', [
            'headers' => [
                'Authorization' => $this->token->getAuthorizationHeader(),
                'Content-Type' => 'application/json'
            ],
            'json' => $dadosReserva
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to reserve location. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }
}
