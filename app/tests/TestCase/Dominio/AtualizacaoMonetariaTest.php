<?php
declare(strict_types=1);

namespace App\Test\TestCase\Dominio;

use App\Dominio\AtualizacaoMonetaria;
use App\Dominio\AtualizacaoMonetaria\Parcela;
use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;
use App\Dominio\Indice\GeradorIndiceMensal;
use App\Dominio\Indice\IndiceProviderMemoria;
use App\Dominio\Indice\TipoIndice;
use Cake\TestSuite\TestCase;

class AtualizacaoMonetariaTest extends TestCase
{
    public function test_construct(): void
    {
        $atualizacao = new AtualizacaoMonetaria(
            'Relação de Despesas',
            new \DateTimeImmutable('2011-04-07')
        );

        $dataInicio = new \DateTimeImmutable('2011-04-07');
        $dataFim = new \DateTimeImmutable('2020-04-30');

        $indices = [
            new Parcela\IndicePeriodo(
                TipoIndice::buildIGPM(),
                $dataInicio,
                $dataFim,
                true
            ),
        ];

        $juros = new Juros(
            1,
            $dataInicio,
            $dataFim,
            true
        );

        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria());

        $atualizacao->adicionarParcela(new Parcela(
            $dataInicio,
            $dataFim,
            'IPTU',
            1000,
            $indices,
            $juros,
            $gerador
        ));

        $this->assertInstanceOf(AtualizacaoMonetaria::class, $atualizacao);
    }

    public function test_get_data_fim_mes_futuro(): void
    {
        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria());
        $dataFim = $gerador->getDataFimMes(
            new \DateTimeImmutable('2020-01-01'),
            new \DateTimeImmutable('2020-02-01'),
        );
        $this->assertEquals(new \DateTimeImmutable('2020-01-31'), $dataFim);
    }

    public function test_get_data_fim_mesmo_mes(): void
    {
        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria());
        $dataFim = $gerador->getDataFimMes(
            new \DateTimeImmutable('2020-01-01'),
            new \DateTimeImmutable('2020-01-15'),
        );
        $this->assertEquals(new \DateTimeImmutable('2020-01-15'), $dataFim);
    }

    public function test_pular_mes(): void
    {
        $gerador = new GeradorIndiceMensal(new IndiceProviderMemoria());
        $proximoMes = $gerador->pularMes(new \DateTimeImmutable('2020-03-01'));
        $this->assertEquals(new \DateTimeImmutable('2020-04-01'), $proximoMes);

        $proximoMes = $gerador->pularMes(new \DateTimeImmutable('2020-03-05'));
        $this->assertEquals(new \DateTimeImmutable('2020-04-01'), $proximoMes);
    }

    public function test_get_sugestao_data_inicio_juros(): void
    {
        $dataCitacao = new \DateTimeImmutable('2011-04-07');
        $dataInicioParcela = new \DateTimeImmutable('2011-04-01');
        $atualizacao = new AtualizacaoMonetaria(
            'Relação de Despesas',
            $dataCitacao
        );
        $this->assertEquals($dataCitacao, $atualizacao->getSugestaoDataInicioJuros($dataInicioParcela));

        $dataInicioParcela = new \DateTimeImmutable('2011-05-01');
        $this->assertEquals($dataInicioParcela, $atualizacao->getSugestaoDataInicioJuros($dataInicioParcela));
    }
}
