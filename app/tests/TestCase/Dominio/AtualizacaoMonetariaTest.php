<?php

namespace App\Test\TestCase\Dominio;

use App\Dominio\AtualizacaoMonetaria;
use App\Dominio\AtualizacaoMonetaria\Parcela;
use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;
use App\Dominio\Indice\GeradorIndiceMensal;
use App\Dominio\Indice\TipoIndice;
use Cake\TestSuite\TestCase;

class AtualizacaoMonetariaTest extends TestCase
{

    public function test_construct()
    {
        $atualizacao = new AtualizacaoMonetaria('Relação de Despesas');

        $dataInicio = new \DateTimeImmutable('2011-04-07');
        $dataFim = new \DateTimeImmutable('2020-04-30');

        $gerador = new GeradorIndiceMensal();

        $indices = $gerador->gerar(
            TipoIndice::buildIGPM(),
            $dataInicio,
            $dataFim,
            true
        );

        $atualizacao->adicionarParcela(new Parcela(
            $dataInicio,
            $dataFim,
            'IPTU',
            $indices,
            new Juros(
                1,
                $dataInicio,
                $dataFim,
                true
            )
        ));

        $this->assertInstanceOf(AtualizacaoMonetaria::class, $atualizacao);
    }

    public function test_get_data_fim_mes_futuro()
    {
        $gerador = new GeradorIndiceMensal();
        $dataFim = $gerador->getDataFimMes(
            new \DateTimeImmutable('2020-01-01'),
            new \DateTimeImmutable('2020-02-01'),
        );
        $this->assertEquals(new \DateTimeImmutable('2020-01-31'), $dataFim);
    }

    public function test_get_data_fim_mesmo_mes()
    {
        $gerador = new GeradorIndiceMensal();
        $dataFim = $gerador->getDataFimMes(
            new \DateTimeImmutable('2020-01-01'),
            new \DateTimeImmutable('2020-01-15'),
        );
        $this->assertEquals(new \DateTimeImmutable('2020-01-15'), $dataFim);
    }

    public function test_pular_mes()
    {
        $gerador = new GeradorIndiceMensal();
        $proximoMes = $gerador->pularMes(new \DateTimeImmutable('2020-03-01'));
        $this->assertEquals(new \DateTimeImmutable('2020-04-01'), $proximoMes);

        $proximoMes = $gerador->pularMes(new \DateTimeImmutable('2020-03-05'));
        $this->assertEquals(new \DateTimeImmutable('2020-04-01'), $proximoMes);
    }
}
