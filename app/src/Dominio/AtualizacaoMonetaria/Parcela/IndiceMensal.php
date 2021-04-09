<?php


namespace App\Dominio\AtualizacaoMonetaria\Parcela;


use App\Dominio\Indice\TipoIndice;

class IndiceMensal
{
    private TipoIndice $tipo;
    private \DateTimeImmutable $dataInicio;
    private \DateTimeImmutable $dataFim;
    private string $indice;
    private bool $proRata;

    public function __construct(
        TipoIndice $tipo,
        \DateTimeImmutable $dataInicio,
        \DateTimeImmutable $datafim,
        string $indice,
        bool $proRata)
    {
        $this->tipo = $tipo;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $datafim;
        $this->indice = $indice;
        $this->proRata = $proRata;
    }

    public function getTipo(): TipoIndice
    {
        return $this->tipo;
    }

    public function getDataInicio(): \DateTimeImmutable
    {
        return $this->dataInicio;
    }

    public function getDataFim(): \DateTimeImmutable
    {
        return $this->dataFim;
    }

    public function getIndice(): string
    {
        return $this->indice;
    }

    public function isProRata(): bool
    {
        return $this->proRata;
    }


}
