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
        if (!$this->isProRata()) {
            return $this->indice;
        }

        $quantidadeDiasMes = $this->dataInicio->format('t');
        $diff = $this->dataFim->diff($this->dataInicio);
        $diasIntervalo = $diff->days + 1;
        $calcularProRata = $diasIntervalo < $quantidadeDiasMes;

        if (!$calcularProRata) {
            return $this->indice;
        }

        $indiceDiario = $this->indice / 30;
        return (string)($indiceDiario * $diasIntervalo);
    }

    public function isProRata(): bool
    {
        return $this->proRata;
    }


}
