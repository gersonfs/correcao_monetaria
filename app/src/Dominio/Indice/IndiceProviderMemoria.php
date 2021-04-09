<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

class IndiceProviderMemoria implements IndiceProvider
{

    /**
     * @var array<int, array{'data': \DateTimeImmutable, 'indice': float}>
     */
    private array $indices;

    /**
     * @param array<int, array{'data': \DateTimeImmutable, 'indice': float}> $indices
     */
    public function __construct(array $indices = [])
    {
        $this->indices = $indices;
    }

    public function getIndice(TipoIndice $tipo, \DateTimeImmutable $data): float
    {
        $achou = array_filter(
            $this->indices,
            fn($indice) => $indice['mes'] == $data->format('m')
                           && $indice['ano'] == $data->format('Y')
        );
        if ($achou) {
            $primeiroResultado = array_pop($achou);
            return $primeiroResultado['indice'];
        }
        return 0;
    }
}
