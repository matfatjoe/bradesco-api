<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;

// Configuração
$pfxPath = __DIR__ . '/certificado.pfx';
$passphrase = 'senha_do_certificado';
$clientId = 'seu_client_id';
$clientSecret = 'seu_client_secret';
$baseUrl = 'https://openapisandbox.prebanco.com.br';

try {
    // 1. Autenticação
    echo "🔑 Autenticando...\n";
    $tokenRequest = new TokenRequest($pfxPath, $passphrase, $clientId, $clientSecret);
    $httpClient = HttpClientFactory::create();
    $authenticator = new Authenticator($httpClient, $baseUrl);
    $token = $authenticator->getToken($tokenRequest);
    echo "✅ Autenticado!\n\n";

    // 2. Serviço
    $boletoService = new BoletoService($httpClient, $token, $baseUrl);

    // 3. Alterar Boleto
    // Dados baseados no Postman collection
    $dadosAlteracao = [
        "codUsuario" => "NETEMPR",
        "vnmnalTitloCobr" => 655, // 6,55
        "chave" => [
            "cnpjCpf" => 38052160,
            "filial" => 57,
            "controle" => "01",
            "idprod" => 9,
            "ctaprod" => 39950075557,
            "nossoNumero" => "2570068544"
        ],
        "dadosTitulo" => [
            "seuNumero" => "JFM ALT 1010",
            "dataEmissao" => 0,
            "especie" => "002",
            "dataVencimento" => 22122024,
            "codVencimento" => 0,
            "codInstrucaoProtesto" => 0,
            "diasProtesto" => 0,
            "codDecurso" => 0,
            "diasDecurso" => 0,
            "codAbatimento" => 0,
            "valorAbatimentoTitulo" => 0,
            "dataPrimeiroDesc" => 0,
            "valorPrimeiroDesc" => 0,
            "codPrimeiroDesc" => 0,
            "acaoPrimeiroDesc" => 0,
            "dataSegundoDesc" => 0,
            "valorSegundoDesc" => 0,
            "codSegundoDesc" => 0,
            "acaoSegundoDesc" => 0,
            "dataTerceiroDesc" => 0,
            "valorTerceiroDesc" => 0,
            "codTerceiroDesc" => 0,
            "acaoTerceiroDesc" => 0,
            "controleParticipante" => "11111111111111111",
            "idAvisoSacado" => "S",
            "diasAposVencidoJuros" => 0,
            "valorJuros" => 0,
            "codJuros" => 0,
            "diasAposVencimentoMulta" => 0,
            "valorMulta" => 0,
            "codMulta" => 0,
            "codNegativacao" => 0,
            "diasNegativacao" => 0,
            "codPagamentoParcial" => "N",
            "qtdePagamentosParciais" => 0,
            "sacado" => "",
            "cgcCpfSacado" => "0",
            "endereco" => "",
            "cep" => 0,
            "cepSuf" => 0,
            "sacadorAvalista" => "",
            "aceite" => "0",
            "cgcCpfAvalista" => "0"
        ]
    ];

    echo "📡 Enviando requisição de alteração...\n";
    
    // Opcional: txId
    $txId = "20241122237093995007555702570068544";
    
    $result = $boletoService->alterar($dadosAlteracao, $txId);

    echo "✅ Boleto Alterado!\n";
    print_r($result);

} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
