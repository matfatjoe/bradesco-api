<?php

namespace Matfatjoe\BradescoBoleto;

use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use GuzzleHttp\Client;

/**
 * Factory para criar cliente HTTP configurado com certificado mTLS
 */
class HttpClientFactory
{
    /**
     * Cria um cliente HTTP configurado com certificado mTLS
     *
     * @param TokenRequest $tokenRequest Requisição de token contendo certificado
     * @param int $timeout Timeout em segundos
     * @return Client Cliente HTTP configurado
     */
    public static function createFromTokenRequest(TokenRequest $tokenRequest, int $timeout = 30): Client
    {
        // Criar cliente com certificado e chave configurados
        return new Client([
            'timeout' => $timeout,
            'connect_timeout' => 10,
            'cert' => $tokenRequest->getCertPath(),
            'ssl_key' => $tokenRequest->getKeyPath(),
            'verify' => true,
            'http_errors' => false
        ]);
    }
}
