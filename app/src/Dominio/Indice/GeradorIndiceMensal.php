<?php


namespace App\Dominio\Indice;


use App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal;
use App\Dominio\Indice\TipoIndice;

class GeradorIndiceMensal
{

    /**
     * @return \App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal[]
     */
    public function gerar(
        TipoIndice $tipoIndice,
        \DateTimeImmutable $dataInicio,
        \DateTimeImmutable $dataFim,
        bool $proRata): array
    {
        $dataInicio = $dataInicio->setTime(0, 0, 0);
        $dataFim = $dataFim->setTime(0, 0, 0);
        if ($dataFim < $dataInicio) {
            throw new \InvalidArgumentException('Informe um período válido!');
        }

        $indices = [];
        $dataAtual = $dataInicio;
        while ($dataAtual <= $dataFim) {
            $dataFimMes = $this->getDataFimMes($dataAtual, $dataFim);
            $indices[] = new IndiceMensal($tipoIndice, $dataAtual, $dataFimMes,0, $proRata);
            $dataAtual = $this->pularMes($dataAtual);
        }

        return $indices;
    }

    public function pularMes(\DateTimeImmutable $data): \DateTimeImmutable
    {
        return $data->setDate(
            (int)$data->format('Y'),
            (int)$data->format('m') + 1,
            1
        );
    }

    public function getDataFimMes(\DateTimeImmutable $dataAtual, \DateTimeImmutable $dataFim)
    {
        $isUltimoMes = $dataAtual->format('Y-m') === $dataFim->format('Y-m');
        if($isUltimoMes) {
            return clone $dataFim;
        }

        return $dataAtual->modify('last day of this month');
    }
}
