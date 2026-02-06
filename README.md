# Bradesco Boleto API - PHP Library

[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Biblioteca PHP para integração com a API de Cobrança do Bradesco, permitindo o gerenciamento completo de boletos bancários e workspaces.

## 📋 Índice

- [Características](#-características)
- [Requisitos](#-requisitos)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Uso Básico](#-uso-básico)
- [Módulos](#-módulos)
- [Exemplos](#-exemplos)
- [Testes](#-testes)
- [Documentação da API](#-documentação-da-api)
- [Contribuindo](#-contribuindo)
- [Licença](#-licença)

## ✨ Características

- ✅ **Autenticação mTLS** - Suporte completo a certificados digitais
- ✅ **Registro de Boletos** - Emissão de boletos híbridos com QR Code
- ✅ **Alteração de Boletos** - Modificação de dados de boletos já registrados
- ✅ **Baixa de Boletos** - Solicitação de baixa de títulos
- ✅ **Consultas** - Consulta de boletos por nosso número
- ✅ **Listagem** - Lista de boletos liquidados com filtros
- ✅ **Reserva de Location** - Reserva de ID Location para QR Code
- ✅ **Webhooks** - Cadastro e gerenciamento de webhooks
- ✅ **PSR-4 Autoloading** - Estrutura moderna e organizada
- ✅ **Type Hints** - Código fortemente tipado para PHP 7.4+

## 📦 Requisitos

- PHP >= 7.4
- Composer
- Extensões PHP:
  - `ext-json`
  - `ext-openssl`
  - `ext-curl`
- Certificado digital PFX do Bradesco
- Credenciais da API (Client ID e Client Secret)

## 🚀 Instalação

```bash
composer require matfatjoe/bradesco-api
```

Ou clone o repositório:

```bash
git clone https://github.com/matfatjoe/bradesco-api.git
cd bradesco-api
composer install
```

## ⚙️ Configuração

### 1. Certificado Digital

Coloque seu certificado `.pfx` no diretório do projeto e configure as credenciais:

```php
$certPath = __DIR__ . '/certificate.pem';
$keyPath = __DIR__ . '/private.key';
$clientId = 'seu_client_id';
$clientSecret = 'seu_client_secret';
```

### 2. Ambiente

```php
// Sandbox (Testes)
$baseUrl = 'https://openapisandbox.prebanco.com.br';

// Produção
$baseUrl = 'https://openapi.bradesco.com.br';
```

## 💡 Uso Básico

### Autenticação

```php
use Matfatjoe\BradescoBoleto\Auth\Authenticator;
use Matfatjoe\BradescoBoleto\Auth\TokenRequest;
use Matfatjoe\BradescoBoleto\HttpClientFactory;

$tokenRequest = new TokenRequest($certPath, $keyPath, $clientId, $clientSecret);
$httpClient = HttpClientFactory::create();
$authenticator = new Authenticator($httpClient, $baseUrl);
$token = $authenticator->getToken($tokenRequest);
```

### Registrar Boleto

```php
use Matfatjoe\BradescoBoleto\Boleto\BoletoService;
use Matfatjoe\BradescoBoleto\Boleto\RegisterBoletoBradescoRequest;
use Matfatjoe\BradescoBoleto\Models\BoletoBradesco;

$boletoService = new BoletoService($httpClient, $token, $certPath, $keyPath, $baseUrl);

$dadosBoleto = [
    'ctitloCobrCdent' => 0,
    'registrarTitulo' => 1,
    'nroCpfCnpjBenef' => 68542653,
    'codUsuario' => 'APISERVIC',
    'filCpfCnpjBenef' => '1018',
    'tipoAcesso' => 2,
    'digCpfCnpjBenef' => 38,
    'cidtfdProdCobr' => 9,
    'cnegocCobr' => 111111111111111111,
    'tipoRegistro' => 1,
    'codigoBanco' => 237,
    'demisTitloCobr' => '17.12.2024',
    'ctitloCliCdent' => 'TESTEBIA',
    'dvctoTitloCobr' => '20.02.2025',
    'vnmnalTitloCobr' => 6000,
    'cindcdEconmMoeda' => 9,
    'cespceTitloCobr' => 2,
    'cindcdAceitSacdo' => 'N',
    'cindcdPgtoParcial' => 'N',
    'cformaEmisPplta' => '02',
    'fase' => '1',
    'cindcdCobrMisto' => 'S',
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
    'nroCpfCnpjSacdo' => 38453450803
];

$boleto = new BoletoBradesco($dadosBoleto);
$resultado = $boletoService->register(new RegisterBoletoBradescoRequest($boleto));
```

### Consultar Boleto

```php
use Matfatjoe\BradescoBoleto\Query\QueryService;

$queryService = new QueryService($httpClient, $token, $certPath, $keyPath, $baseUrl);

$dadosConsulta = [
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

$boleto = $queryService->consultar($dadosConsulta);
```

### Alterar Boleto

```php
$dadosAlteracao = [
    'codUsuario' => 'NETEMPR',
    'vnmnalTitloCobr' => 655,
    'chave' => [
        'cnpjCpf' => 38052160,
        'filial' => 57,
        'controle' => '01',
        'idprod' => 9,
        'ctaprod' => 39950075557,
        'nossoNumero' => '2570068544'
    ],
    'dadosTitulo' => [
        'seuNumero' => 'JFM ALT 1010',
        'dataVencimento' => 22122024,
        // ... outros campos
    ]
];

$resultado = $boletoService->alterar($dadosAlteracao, '20241122237093995007555702570068544');
```

### Baixar Boleto

```php
$dadosBaixa = [
    'cpfCnpj' => [
        'cpfCnpj' => '1234567',
        'filial' => '1',
        'controle' => '99'
    ],
    'produto' => 9,
    'negociacao' => 28560222654,
    'nossoNumero' => '50150001462',
    'sequencia' => 0,
    'codigoBaixa' => 57
];

$resultado = $boletoService->baixar($dadosBaixa);

### Listar Boletos Liquidados

```php
use Matfatjoe\BradescoBoleto\Boleto\ListSettledBoletosBradescoRequest;

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

$boletos = $boletoService->listarLiquidados($request);
```
```

### Listar Boletos Liquidados

```php
$filtros = [
    'cpfCnpj' => [
        'cpfCnpj' => 114383908,
        'filial' => 0,
        'controle' => 7
    ],
    'produto' => 9,
    'negociacao' => 28560230114,
    'dataPagamentoDe' => 14092017,
    'dataPagamentoAte' => 15092025
];

$boletos = $queryService->listar($filtros);
```

### Reservar ID Location

```php
use Matfatjoe\BradescoBoleto\Location\LocationService;

$locationService = new LocationService($httpClient, $token, $certPath, $keyPath, $baseUrl);

$dadosReserva = [
    'codUsuario' => 'APISERVIC',
    'cnpjCpfBnf' => 68542653,
    'cflialCnpjCpfBnf' => 1018,
    'cctrlCnpjCpfBnf' => 38,
    'cidtfdProdCobr' => 9,
    'agenciaCobr' => 3861,
    'contaCobr' => 41000
];

$location = $locationService->reservar($dadosReserva);
```

### Cadastrar Webhook

```php
use Matfatjoe\BradescoBoleto\Webhook\WebhookService;

$webhookService = new WebhookService($httpClient, $token, $certPath, $keyPath, $baseUrl);

$dadosWebhook = [
    'documento' => [
        'cpfCnpj' => '1234567',
        'filial' => '1',
        'controle' => '99'
    ],
    'versaoLayout' => '1',
    'tipoCadastro' => 'C',
    'utilizaWebhook' => 'S',
    'urlEnvio' => 'http://empresa.com.br',
    'tipoAviso' => '1'
];

$resultado = $webhookService->cadastrar($dadosWebhook);
```

## 📚 Módulos

### 🔐 Auth Module

- `Authenticator` - Autenticação mTLS
- `TokenRequest` - Requisição de token
- `HttpClientFactory` - Cliente HTTP configurado

### 📄 Boleto Module

- `BoletoService` - Registro, alteração, baixa e listagem de liquidados
- `RegisterBoletoBradescoRequest` - Request para registro
- `ListSettledBoletosBradescoRequest` - Request para listagem de liquidados
- `BoletoBradesco` - Model de boleto do Bradesco

### 🔍 Query Module

- `QueryService` - Consultas e listagem de boletos
- Métodos: consultar por nosso número, listar liquidados

### 📍 Location Module

- `LocationService` - Reserva de ID Location para QR Code

### 🔔 Webhook Module

- `WebhookService` - Cadastro e gerenciamento de webhooks

## 📖 Exemplos

Veja a pasta `examples/` para exemplos completos (a ser criada):

- `example-auth.php` - Autenticação
- `example-workspace.php` - Gerenciamento de workspaces
- `example-boleto.php` - Registro de boletos
- `list_settled_boletos.php` - Listagem de liquidados
- `example-query.php` - Consultas

## 🧪 Testes

Execute os testes unitários:

```bash
composer test
```

Ou com Docker:

```bash
docker-compose run --rm php vendor/bin/phpunit --testdox
```

## 📘 Documentação da API

- [Portal do Desenvolvedor Bradesco](https://developers.bradesco.com.br/)

## 🤝 Contribuindo

Contribuições são bem-vindas! Por favor:

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Add: Minha nova feature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🆘 Suporte

- 🐛 Issues: [GitHub Issues](https://github.com/matfatjoe/bradesco-api/issues)

---

**Desenvolvido por [Matheus Furquim de Camargo](https://github.com/matfatjoe)**
