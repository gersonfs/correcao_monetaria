<?php


namespace App\Dominio\AtualizacaoMonetaria;


use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;
use App\Dominio\Indice\AcumularIndices;
use App\Dominio\Indice\GeradorIndice;

class Parcela
{

    private \DateTimeImmutable $dataInicio;
    private \DateTimeImmutable $dataFim;
    private string $descricao;
    private float $valor;
    /**
     * @var \App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo[]
     */
    private array $indices;
    private Juros $juros;

    /**
     * Parcela constructor.
     * @param \App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo[] $indices
     */
    public function __construct(
        \DateTimeImmutable $dataInicio,
        \DateTimeImmutable $dataFim,
        string $descricao,
        float $valor,
        array $indices,
        Juros $juros)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->indices = $indices;
        $this->juros = $juros;
    }

    public function getDataInicio(): \DateTimeImmutable
    {
        return $this->dataInicio;
    }

    public function getDataFim(): \DateTimeImmutable
    {
        return $this->dataFim;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getIndiceCorrecao(GeradorIndice $gerador, int $casasDecimais): float
    {
        $indices = [];
        foreach ($this->indices as $periodo) {
            $indicesGerados = $gerador->gerar($periodo);
            foreach($indicesGerados as $indice) {
                $indices[] = $indice->getIndice();
            }
        }
        $acumular = new AcumularIndices();
        return round($acumular->acumular($indices), $casasDecimais);
    }

    public function getValorCorrigido(float $indice, int $casasDecimais = 2): float
    {
        return round($this->valor * $indice, $casasDecimais);
    }

    public function getValorCorrecao(float $indice, int $casasDecimais = 2): float
    {
        return round($this->valor * $indice, $casasDecimais) - $this->valor;
    }

}
