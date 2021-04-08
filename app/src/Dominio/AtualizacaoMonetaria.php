<?php


namespace App\Dominio;


use App\Dominio\AtualizacaoMonetaria\Parcela;

class AtualizacaoMonetaria
{
    private string $titulo;
    private array $parcelas;

    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->parcelas = [];
    }

    public function adicionarParcela(Parcela $parcela)
    {
        $this->parcelas[] = $parcela;
    }

}
