<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

class TipoIndice
{
    private string $tipo;

    /**
     * @var string[]
     */
    private static array $tipos = [
        'IGPM' => 'IGPM',
        'TR' => 'TR',
        'INPC' => 'INPC',
        'IPC/IBGE' => 'IPC/IBGE',
        'IPC/FIPE' => 'IPC/FIPE',
        'INPC/IBGE' => 'INPC/IBGE',
        'IPC-R-IBGE' => 'IPC-R-IBGE',
        'IPCA-E/IBGE' => 'IPCA-E/IBGE',
        'UFIR' => 'UFIR',
        'SELIC' => 'SELIC',
        'OUTRO' => 'OUTRO',
    ];

    private function __construct(string $tipo)
    {
        $indices = array_keys(self::$tipos);
        if (!in_array($tipo, $indices)) {
            throw new \InvalidArgumentException('Tipo de índice inválido!');
        }
        $this->tipo = $tipo;
    }

    public static function buildIGPM(): self
    {
        return new self('IGPM');
    }

    /**
     * @return array<string, string>
     */
    public static function listIndices(): array
    {
        return self::$tipos;
    }
}
