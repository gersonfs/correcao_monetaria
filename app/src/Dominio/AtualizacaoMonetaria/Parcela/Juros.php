<?php
declare(strict_types=1);

namespace App\Dominio\AtualizacaoMonetaria\Parcela;

use App\Dominio\Indice\AcumularIndices;

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
        $inicioJuros = $inicioJuros->setTime(0, 0, 0);
        $fimJuros = $fimJuros->setTime(0, 0, 0);
        if ($inicioJuros >= $fimJuros) {
            throw new \InvalidArgumentException('O início dos juros deve ser menor que o fim!');
        }
        $this->juros = $juros;
        $this->inicioJuros = $inicioJuros;
        $this->fimJuros = $fimJuros;
        $this->jurosComposto = $jurosComposto;
    }

    /**
     * @return array<string>
     */
    public function getIndicesPorMes(): array
    {
        $indices = [];
        $dataAtual = clone $this->inicioJuros;
        while ($dataAtual <= $this->fimJuros) {
            $indices[] = $this->getIndice($dataAtual);
            $dataAtual = $dataAtual
                ->modify('first day of this month')
                ->modify('+1 month');
        }

        return $indices;
    }

    public function getIndiceTotal(): float
    {
        if (!$this->jurosComposto) {
            return 1 + (array_sum($this->getIndicesPorMes()) / 100);
        }

        $acumular = new AcumularIndices();

        return $acumular->acumular($this->getIndicesPorMes());
    }

    public function getIndice(\DateTimeImmutable $dataAtual): string
    {
        $diasRestantes = $this->getDiasJurosMes($dataAtual);
        $isMesCheio = $diasRestantes == 30;
        if ($isMesCheio) {
            return (string)$this->juros;
        }

        return (string)($this->juros / 30 * $diasRestantes);
    }

    public function getDiasJurosMes(\DateTimeImmutable $dataAtual): int
    {
        $dias = 30;
        $isUltimoMes = $dataAtual->format('Y-m') == $this->fimJuros->format('Y-m');
        $diaFimJuros = (int)$this->fimJuros->format('d');
        $diasUltimoMesJuros = (int)$this->fimJuros->format('t');
        $dataFimCoincideUltimoDiaMes = $diaFimJuros == $diasUltimoMesJuros;
        if ($isUltimoMes && !$dataFimCoincideUltimoDiaMes) {
            $diferencaDias = $diasUltimoMesJuros - $diaFimJuros;
            $dias = 30 - $diferencaDias;
        }

        $diaInicio = (int)$dataAtual->format('d');
        $dias -= $diaInicio - 1;

        return $dias;
    }
}
