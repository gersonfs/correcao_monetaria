<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

class IndiceMensalProviderMemoria implements IndiceMensalProvider
{

    private array $indices;

    public function __construct(array $indices = [])
    {
        $this->indices = $indices;
    }

    public function getIndice(TipoIndice $tipo, int $mes, int $ano): float
    {
        $achou = array_filter($this->indices, fn($indice) => $indice['mes'] == $mes && $indice['ano'] == $ano);
        if ($achou) {
            return $achou['indice'];
        }
        return 0;
    }
}
