<?php
declare(strict_types=1);

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
    private GeradorIndice $geradorIndice;

    /**
     * Parcela constructor.
     *
     * @param \DateTimeImmutable $dataInicio
     * @param \DateTimeImmutable $dataFim
     * @param string $descricao
     * @param float $valor
     * @param \App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo[] $indices
     * @param \App\Dominio\AtualizacaoMonetaria\Parcela\Juros $juros
     * @param \App\Dominio\Indice\GeradorIndice $geradorIndice
     */
    public function __construct(
        \DateTimeImmutable $dataInicio,
        \DateTimeImmutable $dataFim,
        string $descricao,
        float $valor,
        array $indices,
        Juros $juros,
        GeradorIndice $geradorIndice
    ) {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->indices = $indices;
        $this->juros = $juros;
        $this->geradorIndice = $geradorIndice;
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

    public function getIndiceCorrecao(int $casasDecimais = 7): float
    {
        $indices = [];
        foreach ($this->indices as $periodo) {
            $indicesGerados = $this->geradorIndice->gerar($periodo);
            foreach ($indicesGerados as $indice) {
                $indices[] = $indice->getIndice();
            }
        }
        $acumular = new AcumularIndices();

        return round($acumular->acumular($indices), $casasDecimais);
    }

    public function getValorCorrigido(int $casasDecimais = 2): float
    {
        return round($this->valor * $this->getIndiceCorrecao(), $casasDecimais);
    }

    public function getValorCorrecao(int $casasDecimais = 2): float
    {
        return round($this->valor * $this->getIndiceCorrecao(), $casasDecimais) - $this->valor;
    }

    public function getValorJuros(int $casasDecimais = 2): float
    {
        $indice = $this->juros->getIndiceTotal();

        return round($this->valor * ($indice - 1), $casasDecimais);
    }

    public function getValorAtualizado(int $casasDecimaisValor = 2, int $casasDecimaisIndice = 7): float
    {
        $valor = $this->getIndiceCorrecao($casasDecimaisIndice) * $this->valor +
            $this->getValorJuros();

        return round($valor, $casasDecimaisValor);
    }
}
