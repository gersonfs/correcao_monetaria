<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

class IndiceMensalProviderMemoria implements IndiceMensalProvider
{

    /**
     * @var array<int, array{'mes': int, 'ano': int, 'indice': float}>
     */
    private array $indices;

    /**
     * @param array<int, array{'mes': int, 'ano': int, 'indice': float}> $indices
     */
    public function __construct(array $indices = [])
    {
        $this->indices = $indices;
    }

    public function getIndice(TipoIndice $tipo, int $mes, int $ano): float
    {
        $achou = array_filter($this->indices, fn($indice) => $indice['mes'] == $mes && $indice['ano'] == $ano);
        if ($achou) {
            $primeiroResultado = array_pop($achou);
            return $primeiroResultado['indice'];
        }
        return 0;
    }
}
