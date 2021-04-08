<?php


namespace App\Dominio\AtualizacaoMonetaria\Parcela;


use App\Dominio\Indice\TipoIndice;

class IndiceMensal
{
    private TipoIndice $tipo;
    private \DateTimeImmutable $dataInicio;
    private \DateTimeImmutable $dataFim;
    private float $indice;
    private bool $proRata;

    public function __construct(
        TipoIndice $tipo,
        \DateTimeImmutable $dataInicio,
        \DateTimeImmutable $datafim,
        float $indice,
        bool $proRata)
    {
        $this->tipo = $tipo;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $datafim;
        $this->indice = $indice;
        $this->proRata = $proRata;
    }
}
