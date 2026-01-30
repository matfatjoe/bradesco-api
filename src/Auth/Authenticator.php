<?php

namespace Matfatjoe\BradescoBoleto\Auth;

use Matfatjoe\BradescoBoleto\Models\Token;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class Authenticator
{
    private $client;
    private $baseUrl;

    public function __construct(
        ClientInterface $client,
        string $baseUrl = 'https://openapisandbox.prebanco.com.br'
    ) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get OAuth2 token using mTLS certificate authentication
     *
     * @param TokenRequest $request
     * @return Token
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getToken(TokenRequest $request): Token
    {
        $response = $this->client->request('POST', $this->baseUrl . '/auth/server-mtls/v2/token', [
            'form_params' => $request->toArray(),
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'cert' => $request->getCertPath(),
            'ssl_key' => $request->getKeyPath(),
            'verify' => true
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (!isset($data['access_token'])) {
            throw new \Exception('Failed to retrieve access token');
        }

        return Token::fromArray($data);
    }
}
