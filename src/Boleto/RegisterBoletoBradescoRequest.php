<?php

namespace Matfatjoe\BradescoBoleto\Boleto;

use Matfatjoe\BradescoBoleto\Models\BoletoBradesco;

/**
 * Request para registrar um novo boleto no Bradesco
 */
class RegisterBoletoBradescoRequest
{
    private $boleto;

    public function __construct(BoletoBradesco $boleto)
    {
        $this->boleto = $boleto;
    }

    public function getBoleto(): BoletoBradesco
    {
        return $this->boleto;
    }

    public function toArray(): array
    {
        return $this->boleto->toArray();
    }
}
