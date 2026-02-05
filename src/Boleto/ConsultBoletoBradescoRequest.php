<?php

namespace Matfatjoe\BradescoBoleto\Boleto;

/**
 * Request para consultar um boleto no Bradesco
 */
class ConsultBoletoBradescoRequest
{
    /** @var int|string numeric (11), required. Agência (4) + Conta (7) */
    private $contaProduto;
    /** @var int|string numeric (2), required. Dígito de controle do CPF/CNPJ */
    private $controleCpfCnpjUsuario;
    /** @var int|string numeric (9), required. Raiz do CPF/CNPJ */
    private $cpfCnpjUsuario;
    /** @var int|string numeric (4), required. Filial do CPF/CNPJ (0 para CPF) */
    private $filialCnpjUsuario;
    /** @var int numeric (2), required. Código da carteira (ex: 09) */
    private $idProduto;
    /** @var string string (8), required. Default: 'bradesco' */
    private $nomePersonalizado;
    /** @var int|string numeric (11), required. Nosso Número sem DV */
    private $nossoNumero;
    /** @var int numeric (3), optional. Sequência do título */
    private $seqTitulo;
    /** @var int numeric (2), optional. Status do título */
    private $status;

    public function __construct(array $data)
    {
        $this->contaProduto = $data['contaProduto'] ?? null;
        $this->controleCpfCnpjUsuario = $data['controleCpfCnpjUsuario'] ?? null;
        $this->cpfCnpjUsuario = $data['cpfCnpjUsuario'] ?? null;
        $this->filialCnpjUsuario = $data['filialCnpjUsuario'] ?? null;
        $this->idProduto = $data['idProduto'] ?? 9;
        $this->nomePersonalizado = $data['nomePersonalizado'] ?? 'bradesco';
        $this->nossoNumero = $data['nossoNumero'] ?? null;
        $this->seqTitulo = $data['seqTitulo'] ?? 0;
        $this->status = $data['status'] ?? 0;
    }

    public function toArray(): array
    {
        return [
            'contaProduto' => $this->contaProduto,
            'controleCpfCnpjUsuario' => $this->controleCpfCnpjUsuario,
            'cpfCnpjUsuario' => $this->cpfCnpjUsuario,
            'filialCnpjUsuario' => $this->filialCnpjUsuario,
            'idProduto' => $this->idProduto,
            'nomePersonalizado' => $this->nomePersonalizado,
            'nossoNumero' => $this->nossoNumero,
            'seqTitulo' => $this->seqTitulo,
            'status' => $this->status,
        ];
    }
}
