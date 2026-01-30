<?php

namespace Matfatjoe\BradescoBoleto\Webhook;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Matfatjoe\BradescoBoleto\Models\Token;

/**
 * Serviço para gerenciamento de Webhooks do Bradesco
 */
class WebhookService
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
     * Cadastra ou atualiza webhook
     *
     * @param array $dadosWebhook Dados do webhook
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function cadastrar(array $dadosWebhook): array
    {
        $response = $this->client->request('POST', $this->baseUrl . '/boleto/cobranca-webhook/v1/cadastrar', [
            'headers' => [
                'Authorization' => $this->token->getAuthorizationHeader(),
                'Content-Type' => 'application/json'
            ],
            'json' => $dadosWebhook
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to register webhook. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }

    /**
     * Executa operação de webhook (produção)
     *
     * @param array $dadosWebhook Dados do webhook
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function executar(array $dadosWebhook): array
    {
        $response = $this->client->request('POST', $this->baseUrl . '/boleto/cobranca-webhook/v1/executar', [
            'headers' => [
                'Authorization' => $this->token->getAuthorizationHeader(),
                'Content-Type' => 'application/json'
            ],
            'json' => $dadosWebhook
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to execute webhook. Status: ' . $response->getStatusCode() . '. Response: ' . $body);
        }

        return $data;
    }
}
