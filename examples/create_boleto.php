<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;
use Matfatjoe\BradescoBoleto\Boleto\RegisterBoletoBradescoRequest;
use Matfatjoe\BradescoBoleto\Models\BoletoBradesco;
use GuzzleHttp\Exception\RequestException;

// Configuração (Substitua pelos seus dados ou use variáveis de ambiente)
$certPath = __DIR__ . '/certificate.pem'; // Caminho para seu certificado PEM
$keyPath = __DIR__ . '/private.key'; // Caminho para sua chave privada PEM
$clientId = 'seu_client_id';
$clientSecret = 'seu_client_secret';
$baseUrl = 'https://openapisandbox.prebanco.com.br'; // Sandbox URL

// Verificar se os arquivos de certificado existem apenas para o exemplo não quebrar imediatamente se não existir
if (!file_exists($certPath)) {
    echo "⚠️  Aviso: Certificado não encontrado em $certPath.\n";
}
if (!file_exists($keyPath)) {
    echo "⚠️  Aviso: Chave privada não encontrada em $keyPath.\n";
}

try {
    // 1. Autenticação
    echo "🔑 Autenticando...\n";
    $tokenRequest = new TokenRequest($certPath, $keyPath, $clientId, $clientSecret);
    $httpClient = HttpClientFactory::create(); 
    $authenticator = new Authenticator($httpClient, $baseUrl);
    $token = $authenticator->getToken($tokenRequest);
    echo "✅ Autenticado! Token: " . substr($token->getAccessToken(), 0, 10) . "...\n\n";

    // 2. Serviço de Boleto
    $boletoService = new BoletoService($httpClient, $token, $certPath, $keyPath, $baseUrl);

    // 3. Dados do Boleto (Baseado no Postman)
    // Note: Em produção, utilize dados reais e validações
    $boletoData = [
        'ctitloCobrCdent' => 0, // 0 para gerar nosso numero pelo banco? Verificar documentação. Postman usa 0.
        'registrarTitulo' => 1,
        'nroCpfCnpjBenef' => 68542653,
        'codUsuario' => 'APISERVIC',
        'filCpfCnpjBenef' => '1018',
        'tipoAcesso' => 2,
        'digCpfCnpjBenef' => 38,
        'cpssoaJuridContr' => '',
        'ctpoContrNegoc' => '',
        'cidtfdProdCobr' => 9,
        'nseqContrNegoc' => '',
        'cnegocCobr' => 111111111111111111, // Negociação
        'filler' => '',
        'eNseqContrNegoc' => '',
        'tipoRegistro' => 1,
        'codigoBanco' => 237,
        'cprodtServcOper' => '',
        'demisTitloCobr' => date('d.m.Y'), // Data atual
        'ctitloCliCdent' => 'TESTEBIA',
        'dvctoTitloCobr' => date('d.m.Y', strtotime('+5 days')), // Vencimento futuro
        'cidtfdTpoVcto' => '',
        'vnmnalTitloCobr' => 6000, // Valor (60.00)
        'cindcdEconmMoeda' => 9,
        'cespceTitloCobr' => 2,
        'qmoedaNegocTitlo' => 0,
        'ctpoProteTitlo' => 0,
        'cindcdAceitSacdo' => 'N',
        'ctpoPrzProte' => 0,
        'ctpoPrzDecurs' => 0,
        'ctpoProteDecurs' => 0,
        'cctrlPartcTitlo' => 0,
        'cindcdPgtoParcial' => 'N',
        'cformaEmisPplta' => '02',
        'qtdePgtoParcial' => 0,
        'qtdDecurPrz' => '0',
        'codNegativacao' => '0',
        'diasNegativacao' => '0',
        'ptxJuroVcto' => 0,
        'filler1' => '',
        'vdiaJuroMora' => 0,
        'pmultaAplicVcto' => 0,
        'qdiaInicJuro' => 0,
        'vmultaAtrsoPgto' => 0,
        'pdescBonifPgto01' => 0,
        'qdiaInicMulta' => 0,
        'vdescBonifPgto01' => 0,
        'pdescBonifPgto02' => 0,
        'dlimDescBonif1' => '',
        'vdescBonifPgto02' => 0,
        'pdescBonifPgto03' => 0,
        'dlimDescBonif2' => '',
        'vdescBonifPgto03' => 0,
        'ctpoPrzCobr' => 0,
        'dlimDescBonif3' => '',
        'pdescBonifPgto' => 0,
        'dlimBonifPgto' => '',
        'vdescBonifPgto' => 0,
        'vabtmtTitloCobr' => 0,
        'filler2' => '',
        'viofPgtoTitlo' => 0,
        'isacdoTitloCobr' => 'TESTE EMPRESA PGIT',
        'enroLogdrSacdo' => 'TESTE',
        'elogdrSacdoTitlo' => 'TESTE',
        'ecomplLogdrSacdo' => 'TESTE',
        'ccepSacdoTitlo' => 6332,
        'ebairoLogdrSacdo' => 'TESTE',
        'ccomplCepSacdo' => 130,
        'imunSacdoTitlo' => 'TESTE',
        'indCpfCnpjSacdo' => 1,
        'csglUfSacdo' => 'SP',
        'renderEletrSacdo' => '',
        'cdddFoneSacdo' => 0,
        'nroCpfCnpjSacdo' => 38453450803,
        'bancoDeb' => 0,
        'cfoneSacdoTitlo' => 0,
        'agenciaDebDv' => 0,
        'agenciaDeb' => 0,
        'bancoCentProt' => 0,
        'contaDeb' => 0,
        'isacdrAvalsTitlo' => '',
        'agenciaDvCentPr' => 0,
        'enroLogdrSacdr' => '0',
        'elogdrSacdrAvals' => '',
        'ecomplLogdrSacdr' => '',
        'ccomplCepSacdr' => 0,
        'ebairoLogdrSacdr' => '',
        'csglUfSacdr' => '',
        'ccepSacdrTitlo' => 0,
        'imunSacdrAvals' => '',
        'indCpfCnpjSacdr' => 0,
        'renderEletrSacdr' => '',
        'nroCpfCnpjSacdr' => 0,
        'cdddFoneSacdr' => 0,
        'filler3' => '0',
        'cfoneSacdrTitlo' => 0,
        'iconcPgtoSpi' => '',
        'fase' => '1',
        'cindcdCobrMisto' => 'S',
        'ialiasAdsaoCta' => '',
        'ilinkGeracQrcd' => '',
        'caliasAdsaoCta' => '',
        'wqrcdPdraoMercd' => '',
        'validadeAposVencimento' => '',
        'filler4' => '',
        'idLoc' => ''
    ];

    $boleto = new BoletoBradesco($boletoData);
    $request = new RegisterBoletoBradescoRequest($boleto);

    echo "📡 Enviando requisição de registro...\n";
    $result = $boletoService->register($request);

    echo "✅ Boleto Registrado!\n";
    print_r($result);
    // Verificar se retornou o nossoNumero ou similar para usar nos próximos exemplos

} catch (RequestException $e) {
    echo "❌ Erro de Requisição: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo "Response Body: " . $e->getResponse()->getBody()->getContents() . "\n";
    }
} catch (\Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
