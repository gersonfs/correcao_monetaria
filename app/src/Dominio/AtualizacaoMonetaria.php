<?php
declare(strict_types=1);

namespace App\Dominio;

use App\Dominio\AtualizacaoMonetaria\Parcela;

class AtualizacaoMonetaria
{
    private string $titulo;
    private \DateTimeImmutable $dataCitacao;

    /**
     * @var \App\Dominio\AtualizacaoMonetaria\Parcela[]
     */
    private array $parcelas;

    public function __construct(string $titulo, \DateTimeImmutable $dataCitacao)
    {
        $this->titulo = $titulo;
        $this->dataCitacao = $dataCitacao;
        $this->parcelas = [];
    }

    public function adicionarParcela(Parcela $parcela): void
    {
        $this->parcelas[] = $parcela;
    }

    public function getSugestaoDataInicioJuros(\DateTimeImmutable $dataInicioParcela): \DateTimeImmutable
    {
        return max($dataInicioParcela, $this->dataCitacao);
    }
}
