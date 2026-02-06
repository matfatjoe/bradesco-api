<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;
use Matfatjoe\BradescoBoleto\Boleto\ListSettledBoletosBradescoRequest;
use GuzzleHttp\Exception\RequestException;

// Configuração
$certPath = __DIR__ . '/certificate.pem';
$keyPath = __DIR__ . '/private.key';
$clientId = 'seu_client_id';
$clientSecret = 'seu_client_secret';
$baseUrl = 'https://openapisandbox.prebanco.com.br';

try {
    // 1. Autenticação
    echo "🔑 Autenticando...\n";
    $tokenRequest = new TokenRequest($certPath, $keyPath, $clientId, $clientSecret);
    $httpClient = HttpClientFactory::create(); 
    $authenticator = new Authenticator($httpClient, $baseUrl);
    $token = $authenticator->getToken($tokenRequest);
    echo "✅ Autenticado!\n\n";

    // 2. Serviço de Boleto
    $boletoService = new BoletoService($httpClient, $token, $certPath, $keyPath, $baseUrl);

    // 3. Listar Boletos Liquidados
    echo "📡 Listando boletos liquidados...\n";
    $request = new ListSettledBoletosBradescoRequest([
        'cpfCnpj' => [
            'cpfCnpj' => 114383908,
            'filial' => 0,
            'controle' => 7
        ],
        'produto' => 9,
        'negociacao' => 28560230114,
        'dataPagamentoDe' => 14092017,
        'dataPagamentoAte' => 15092025
    ]);

    $result = $boletoService->listarLiquidados($request);

    echo "✅ Listagem realizada com sucesso!\n";
    print_r($result);

} catch (RequestException $e) {
    echo "❌ Erro de Requisição: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo "Response Body: " . $e->getResponse()->getBody()->getContents() . "\n";
    }
} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
