<?php

namespace Matfatjoe\BradescoBoleto\Boleto;

/**
 * Request para listar boletos liquidados no Bradesco
 */
class ListSettledBoletosBradescoRequest
{
    private $cpfCnpj;
    private $produto;
    private $negociacao;
    private $dataMovimentoDe;
    private $dataMovimentoAte;
    private $dataPagamentoDe;
    private $dataPagamentoAte;
    private $origemPagamento;
    private $valorTituloDe;
    private $valorTituloAte;
    private $paginaAnterior;

    public function __construct(array $data)
    {
        $this->cpfCnpj = $data['cpfCnpj'] ?? null;
        $this->produto = $data['produto'] ?? 9;
        $this->negociacao = $data['negociacao'] ?? null;
        $this->dataMovimentoDe = $data['dataMovimentoDe'] ?? 0;
        $this->dataMovimentoAte = $data['dataMovimentoAte'] ?? 0;
        $this->dataPagamentoDe = $data['dataPagamentoDe'] ?? 0;
        $this->dataPagamentoAte = $data['dataPagamentoAte'] ?? 0;
        $this->origemPagamento = $data['origemPagamento'] ?? 0;
        $this->valorTituloDe = $data['valorTituloDe'] ?? 0;
        $this->valorTituloAte = $data['valorTituloAte'] ?? 0;
        $this->paginaAnterior = $data['paginaAnterior'] ?? 0;
    }

    public function toArray(): array
    {
        return [
            'cpfCnpj' => $this->cpfCnpj,
            'produto' => $this->produto,
            'negociacao' => $this->negociacao,
            'dataMovimentoDe' => $this->dataMovimentoDe,
            'dataMovimentoAte' => $this->dataMovimentoAte,
            'dataPagamentoDe' => $this->dataPagamentoDe,
            'dataPagamentoAte' => $this->dataPagamentoAte,
            'origemPagamento' => $this->origemPagamento,
            'valorTituloDe' => $this->valorTituloDe,
            'valorTituloAte' => $this->valorTituloAte,
            'paginaAnterior' => $this->paginaAnterior,
        ];
    }
}
