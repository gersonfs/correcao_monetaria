<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

class AcumularIndices
{
    /**
     * @param \App\Dominio\Indice\Indice[] $indices
     */
    public function acumularFromIndice(array $indices): float
    {
        $percentuais = array_map(fn ($indice) => $indice->getPercentual(), $indices);

        return $this->acumular($percentuais);
    }

    /**
     * @param string[] $percentuais
     * @return float
     */
    public function acumular(array $percentuais): float
    {
        $acumulo = 1;
        foreach ($percentuais as $percentual) {
            $fator = ((float)$percentual) / 100;
            $acumulo += $acumulo * $fator;
        }

        return $acumulo;
    }
}
