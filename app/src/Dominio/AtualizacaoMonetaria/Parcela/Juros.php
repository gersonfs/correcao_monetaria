<?php
declare(strict_types=1);

namespace App\Dominio\AtualizacaoMonetaria\Parcela;

class Juros
{
    private float $juros;
    private \DateTimeImmutable $inicioJuros;
    private \DateTimeImmutable $fimJuros;
    private bool $jurosComposto;

    public function __construct(
        float $juros,
        \DateTimeImmutable $inicioJuros,
        \DateTimeImmutable $fimJuros,
        bool $jurosComposto
    ) {
        $this->juros = $juros;
        $this->inicioJuros = $inicioJuros;
        $this->fimJuros = $fimJuros;
        $this->jurosComposto = $jurosComposto;
    }
}
