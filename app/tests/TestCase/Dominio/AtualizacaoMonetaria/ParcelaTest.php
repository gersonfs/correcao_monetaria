<?php

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

    public function test_construct()
    {
        $dataInicio = new \DateTimeImmutable('2020-01-01');
        $dataFim = new \DateTimeImmutable('2020-04-30');

        $indices = [
            new IndicePeriodo(
                TipoIndice::buildIGPM(),
                $dataInicio,
                $dataFim,
                false
            )
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
            $juros
        );

        $indices = [
            ['mes' => 1, 'ano' => 2020, 'indice' => 0.48],
            ['mes' => 2, 'ano' => 2020, 'indice' => -0.04],
            ['mes' => 3, 'ano' => 2020, 'indice' => 1.24],
            ['mes' => 4, 'ano' => 2020, 'indice' => 0.8],
        ];
        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria($indices));

        $this->assertEquals('IPTU', $parcela->getDescricao());
        $this->assertEquals(1000, $parcela->getValor());
        $indice = $parcela->getIndiceCorrecao($gerador, 7);
        $this->assertEquals(1.02498740, $indice);
        $this->assertEquals(1024.99, round($parcela->getValorCorrigido($indice), 2));
        $this->assertEquals(24.99, round($parcela->getValorCorrecao($indice), 2));
    }
}
