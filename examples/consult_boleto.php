<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;
use Matfatjoe\BradescoBoleto\Boleto\ConsultBoletoBradescoRequest;
use GuzzleHttp\Exception\RequestException;

// Configuração (Substitua pelos seus dados ou use variáveis de ambiente)
$certPath = __DIR__ . '/certificate.pem';
$keyPath = __DIR__ . '/private.key';
$clientId = 'seu_client_id';
$clientSecret = 'seu_client_secret';
$baseUrl = 'https://openapisandbox.prebanco.com.br'; // Sandbox URL

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

    // 3. Dados da Consulta (Baseado no Postman)
    $consultData = [
        'contaProduto' => 38610041000,
        'controleCpfCnpjUsuario' => 38,
        'cpfCnpjUsuario' => 68542653,
        'filialCnpjUsuario' => 1018,
        'idProduto' => 9,
        'nomePersonalizado' => '',
        'nossoNumero' => 970039324,
        'seqTitulo' => 0,
        'status' => 0
    ];

    $request = new ConsultBoletoBradescoRequest($consultData);

    echo "📡 Consultando boleto...\n";
    $result = $boletoService->consultar($request);

    echo "✅ Consulta realizada com sucesso!\n";
    print_r($result);

} catch (RequestException $e) {
    echo "❌ Erro de Requisição: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo "Response Body: " . $e->getResponse()->getBody()->getContents() . "\n";
    }
} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
