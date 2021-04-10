<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

class IndiceProviderMemoria implements IndiceProvider
{

    /**
     * @var array<int, array{'data': \DateTimeImmutable, 'indice': string}>
     */
    private array $indices;

    /**
     * @param array<int, array{'data': \DateTimeImmutable, 'indice': string}> $indices
     */
    public function __construct(array $indices = [])
    {
        $this->indices = $indices;
    }

    public function getIndice(TipoIndice $tipo, \DateTimeImmutable $data): string
    {
        $achou = array_filter(
            $this->indices,
            fn($indice) => $indice['data']->format('m') == $data->format('m')
                           && $indice['data']->format('Y') == $data->format('Y')
        );
        if ($achou) {
            $primeiroResultado = array_pop($achou);
            return $primeiroResultado['indice'];
        }
        return "0";
    }
}
