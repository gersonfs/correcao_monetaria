<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

use App\Dominio\AtualizacaoMonetaria\Parcela\IndiceDiario;
use App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo;

class GeradorIndiceDiario
{
    private IndiceProvider $provider;

    public function __construct(IndiceProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return \App\Dominio\AtualizacaoMonetaria\Parcela\IndiceDiario[]
     */
    public function gerar(IndicePeriodo $periodo): array
    {
        $dataInicio = $periodo->getDiaInicio();
        $dataFim = $periodo->getDiaFim();
        $tipoIndice = $periodo->getTipo();

        $dataInicio = $dataInicio->setTime(0, 0, 0);
        $dataFim = $dataFim->setTime(0, 0, 0);
        if ($dataFim < $dataInicio) {
            throw new \InvalidArgumentException('Informe um período válido!');
        }

        $indices = [];
        $dataAtual = $dataInicio;
        while ($dataAtual <= $dataFim) {
            $indice = $this->provider->getIndice($tipoIndice, $dataAtual);
            $indices[] = new IndiceDiario($tipoIndice, $dataAtual, $indice);
            $dataAtual = $dataAtual->modify('+1 day');
        }

        return $indices;
    }
}
