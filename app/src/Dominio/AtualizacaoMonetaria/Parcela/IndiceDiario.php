<?php


namespace App\Dominio\AtualizacaoMonetaria\Parcela;


use App\Dominio\Indice\TipoIndice;

class IndiceDiario implements Indice
{
    private TipoIndice $tipo;
    private \DateTimeImmutable $data;
    private string $indice;

    public function __construct(
        TipoIndice $tipo,
        \DateTimeImmutable $data,
        string $indice
    )
    {
        $this->tipo = $tipo;
        $this->data = $data;
        $this->indice = $indice;
    }

    public function getTipo(): TipoIndice
    {
        return $this->tipo;
    }

    public function getData(): \DateTimeImmutable
    {
        return $this->data;
    }

    public function getIndice(): string
    {
        return $this->indice;
    }

}
