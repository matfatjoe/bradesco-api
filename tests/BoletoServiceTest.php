<?php

namespace Matfatjoe\BradescoBoleto\Tests\Boleto;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;
use Matfatjoe\BradescoBoleto\Boleto\RegisterBoletoBradescoRequest;
use Matfatjoe\BradescoBoleto\Boleto\ConsultBoletoBradescoRequest;
use Matfatjoe\BradescoBoleto\Models\BoletoBradesco;
use Matfatjoe\BradescoBoleto\Models\Token;
use PHPUnit\Framework\TestCase;

class BoletoServiceTest extends TestCase
{
    private function createMockToken(): Token
    {
        return new Token('test_token', 3600, 'Bearer');
    }

    private function createMockBoleto(): BoletoBradesco
    {
        return new BoletoBradesco([
            'registrarTitulo' => 1,
            'nroCpfCnpjBenef' => 12345678901234
        ]);
    }

    public function testRegisterBoletoSuccess()
    {
        // Mock da resposta de sucesso baseada no Postman/doc
        $responseBody = json_encode([
            'cdErro' => 0,
            'msgErro' => 'Sucesso',
            'idProduto' => 9,
            'negociacao' => 1234567890,
            'clubBanco' => 237,
            'tpContrato' => 1,
            'nuSequenciaContrato' => 123456,
            'cdProduto' => 1,
            'nuTituloGerado' => 99999999999
        ]);

        $mock = new MockHandler([
            new Response(201, [], $responseBody)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new BoletoService($client, $this->createMockToken(), 'cert.pem', 'key.pem');

        $request = new RegisterBoletoBradescoRequest($this->createMockBoleto());
        $result = $service->register($request);

        $this->assertIsArray($result);
        $this->assertEquals(0, $result['cdErro']);
        $this->assertEquals('Sucesso', $result['msgErro']);
        $this->assertEquals(99999999999, $result['nuTituloGerado']);
    }

    public function testAlterarBoletoSuccess()
    {
        $responseBody = json_encode([
            'cdErro' => 0,
            'msgErro' => 'Alteracao efetuada com sucesso',
            // outros campos...
        ]);

        $mock = new MockHandler([
            new Response(200, [], $responseBody)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new BoletoService($client, $this->createMockToken(), 'cert.pem', 'key.pem');

        $dadosAlteracao = [
            'codUsuario' => 'TESTE',
            'dadosTitulo' => ['seuNumero' => '123']
        ];

        $result = $service->alterar($dadosAlteracao, 'txId123');

        $this->assertIsArray($result);
        $this->assertEquals(0, $result['cdErro']);
        $this->assertEquals('Alteracao efetuada com sucesso', $result['msgErro']);
    }

    public function testBaixarBoletoSuccess()
    {
        $responseBody = json_encode([
            'cdErro' => 0,
            'msgErro' => 'Baixa efetuada com sucesso'
        ]);

        $mock = new MockHandler([
            new Response(200, [], $responseBody)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new BoletoService($client, $this->createMockToken(), 'cert.pem', 'key.pem');

        $dadosBaixa = [
            'nossoNumero' => '12345678901'
        ];

        $result = $service->baixar($dadosBaixa);

        $this->assertIsArray($result);
        $this->assertEquals(0, $result['cdErro']);
    }

    public function testRegisterBoletoFailure()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Failed to register boleto');

        $mock = new MockHandler([
            new Response(400, [], json_encode(['error' => 'Dados invalidos']))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new BoletoService($client, $this->createMockToken(), 'cert.pem', 'key.pem');

        $request = new RegisterBoletoBradescoRequest($this->createMockBoleto());
        $service->register($request);
    }

    public function testConsultBoletoSuccess()
    {
        $responseBody = json_encode([
            'cdErro' => 0,
            'msgErro' => 'Consulta efetuada com sucesso',
            'data' => [
                'nossoNumero' => '970039324',
                'status' => 'Aberto'
            ]
        ]);

        $mock = new MockHandler([
            new Response(200, [], $responseBody)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new BoletoService($client, $this->createMockToken(), 'cert.pem', 'key.pem');

        $request = new ConsultBoletoBradescoRequest([
            'contaProduto' => 38610041000,
            'nossoNumero' => 970039324
        ]);
        
        $result = $service->consultar($request);

        $this->assertIsArray($result);
        $this->assertEquals(0, $result['cdErro']);
        $this->assertEquals('970039324', $result['data']['nossoNumero']);
    }
}
