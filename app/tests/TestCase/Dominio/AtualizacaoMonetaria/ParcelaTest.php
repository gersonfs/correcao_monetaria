<?php
declare(strict_types=1);

namespace App\Test\TestCase\Dominio\AtualizacaoMonetaria;

use App\Dominio\AtualizacaoMonetaria\Parcela;
use App\Dominio\AtualizacaoMonetaria\Parcela\IndicePeriodo;
use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;
use App\Dominio\Indice\GeradorIndiceMensal;
use App\Dominio\Indice\IndiceProviderMemoria;
use App\Dominio\Indice\TipoIndice;
use PHPUnit\Framework\TestCase;

class ParcelaTest extends TestCase
{
    public function test_construct(): void
    {
        $dataInicio = new \DateTimeImmutable('2020-01-01');
        $dataFim = new \DateTimeImmutable('2020-04-30');
        $indices = [
            ['data' => new \DateTimeImmutable('2020-01-01'), 'indice' => '0.48'],
            ['data' => new \DateTimeImmutable('2020-02-01'), 'indice' => '-0.04'],
            ['data' => new \DateTimeImmutable('2020-03-01'), 'indice' => '1.24'],
            ['data' => new \DateTimeImmutable('2020-04-01'), 'indice' => '0.8'],
        ];
        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria($indices));

        $indices = [
            new IndicePeriodo(
                TipoIndice::buildIGPM(),
                $dataInicio,
                $dataFim,
                false
            ),
        ];

        $juros = new Juros(
            1,
            $dataInicio,
            $dataFim,
            true
        );
        $parcela = new Parcela(
            $dataInicio,
            $dataFim,
            'IPTU',
            1000,
            $indices,
            $juros,
            $gerador
        );

        $this->assertEquals('IPTU', $parcela->getDescricao());
        $this->assertEquals(1000, $parcela->getValor());
        $indice = $parcela->getIndiceCorrecao(7);
        $this->assertEquals(1.02498740, $indice);
        $this->assertEquals(1024.99, round($parcela->getValorCorrigido(), 2));
        $this->assertEquals(24.99, round($parcela->getValorCorrecao(), 2));
        $this->assertEquals(40.6, $parcela->getValorJuros());
        $this->assertEquals(1065.59, $parcela->getValorAtualizado());
    }
}
