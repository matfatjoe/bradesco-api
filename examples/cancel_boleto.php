<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;

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

    // 2. Serviço
    $boletoService = new BoletoService($httpClient, $token, $certPath, $keyPath, $baseUrl);

    // 3. Baixar (Cancelar) Boleto
    // Dados baseados no Postman collection
    $dadosBaixa = [
        "cpfCnpj" => [
            "cpfCnpj" => "1234567",
            "filial" => "1",
            "controle" => "99"
        ],
        "produto" => 9,
        "negociacao" => 28560222654,
        "nossoNumero" => "50150001462",
        "sequencia" => 0,
        "codigoBaixa" => 57
    ];

    echo "📡 Enviando requisição de baixa...\n";
    $result = $boletoService->baixar($dadosBaixa);

    echo "✅ Boleto Baixado!\n";
    print_r($result);

} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
