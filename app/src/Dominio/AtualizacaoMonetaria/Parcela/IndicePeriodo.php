<?php


namespace App\Dominio\AtualizacaoMonetaria\Parcela;


use App\Dominio\Indice\TipoIndice;

class IndicePeriodo
{
    private TipoIndice $tipo;
    private \DateTimeImmutable $diaInicio;
    private \DateTimeImmutable $diaFim;
    private bool $proRata;

    public function __construct(TipoIndice $tipo, \DateTimeImmutable $diaInicio, \DateTimeImmutable $diaFim, bool $proRata)
    {
        $this->tipo = $tipo;
        $this->diaInicio = $diaInicio;
        $this->diaFim = $diaFim;
        $this->proRata = $proRata;
    }

    public function getTipo(): TipoIndice
    {
        return $this->tipo;
    }

    public function getDiaInicio(): \DateTimeImmutable
    {
        return $this->diaInicio;
    }

    public function getDiaFim(): \DateTimeImmutable
    {
        return $this->diaFim;
    }

    public function isProRata(): bool
    {
        return $this->proRata;
    }


}
