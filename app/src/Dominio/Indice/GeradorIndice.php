<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

use App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo;

interface GeradorIndice
{
    /**
     * @return \App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal[]
     */
    public function gerar(IndicePeriodo $periodo): array;
}
