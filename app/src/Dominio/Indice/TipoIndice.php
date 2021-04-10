<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

class TipoIndice
{
    private string $tipo;

    /**
     * @var string[]
     */
    private array $tipos = [
        'IGPM',
        'TR',
        'INPC',
        'IPC/IBGE',
        'IPC/FIPE',
        'INPC/IBGE',
        'IPC-R-IBGE',
        'IPCA-E/ibge(%)',
        'UFIR',
        'SELIC',
        'OUTRO',
    ];

    private function __construct(string $tipo)
    {
        if (!in_array($tipo, $this->tipos)) {
            throw new \InvalidArgumentException('Tipo de índice inválido!');
        }
        $this->tipo = $tipo;
    }

    public static function buildIGPM(): self
    {
        return new self('IGPM');
    }
}
