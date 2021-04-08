<?php


namespace App\Dominio\AtualizacaoMonetaria;


use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;

class Parcela
{

    private \DateTimeImmutable $dataInicio;
    private \DateTimeImmutable $dataFim;
    private string $descricao;

    /**
     * @var \App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal[]
     */
    private array $indices;
    private Juros $juros;

    /**
     * Parcela constructor.
     * @param \App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal[] $indices
     */
    public function __construct(\DateTimeImmutable $dataInicio, \DateTimeImmutable $dataFim, string $descricao, array $indices, Juros $juros)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->descricao = $descricao;
        $this->indices = $indices;
        $this->juros = $juros;
    }
}
