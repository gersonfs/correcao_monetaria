<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

interface IndiceMensalProvider
{
    public function getIndice(TipoIndice $tipo, int $mes, int $ano): float;
}
