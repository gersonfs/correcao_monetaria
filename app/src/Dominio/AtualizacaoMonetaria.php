<?php
declare(strict_types=1);

namespace App\Dominio;

use App\Dominio\AtualizacaoMonetaria\Parcela;

class AtualizacaoMonetaria
{
    private string $titulo;

    /**
     * @var \App\Dominio\AtualizacaoMonetaria\Parcela[]
     */
    private array $parcelas;

    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->parcelas = [];
    }

    public function adicionarParcela(Parcela $parcela): void
    {
        $this->parcelas[] = $parcela;
    }
}
