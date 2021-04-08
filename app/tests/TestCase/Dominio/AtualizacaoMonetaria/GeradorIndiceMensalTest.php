<?php

namespace App\Test\TestCase\Dominio\AtualizacaoMonetaria;

use App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal;
use App\Dominio\Indice\GeradorIndiceMensal;
use App\Dominio\Indice\TipoIndice;
use Cake\TestSuite\TestCase;

class GeradorIndiceMensalTest extends TestCase
{

    public function test_gerar()
    {
        $gerador = new GeradorIndiceMensal();

        $igpm = TipoIndice::buildIGPM();
        $indices = $gerador->gerar(
            $igpm,
            new \DateTimeImmutable('2020-01-04'),
            new \DateTimeImmutable('2020-03-28'),
            true
        );

        $this->assertCount(3, $indices);
        $indicesEsperados = [
            new IndiceMensal($igpm, new \DateTimeImmutable('2020-01-04'), new \DateTimeImmutable('2020-01-31'), 0, true),
            new IndiceMensal($igpm, new \DateTimeImmutable('2020-02-01'), new \DateTimeImmutable('2020-02-29'), 0, true),
            new IndiceMensal($igpm, new \DateTimeImmutable('2020-03-01'), new \DateTimeImmutable('2020-03-28'), 0, true),
        ];
        $this->assertEquals($indicesEsperados, $indices);

    }
}
