<?php
declare(strict_types=1);

namespace App\Test\TestCase\Dominio\AtualizacaoMonetaria\Parcela;

use App\Dominio\AtualizacaoMonetaria\Parcela\Juros;
use PHPUnit\Framework\TestCase;

class JurosTest extends TestCase
{
    public function test_get_dias_mes(): void
    {
        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-08'),
            new \DateTimeImmutable('2021-05-20'),
            true
        );
        $dataAtual = new \DateTimeImmutable('2021-01-08');
        $this->assertEquals(23, $juros->getDiasJurosMes($dataAtual));

        $dataAtual = new \DateTimeImmutable('2021-02-01');
        $this->assertEquals(30, $juros->getDiasJurosMes($dataAtual));

        $dataAtual = new \DateTimeImmutable('2021-03-01');
        $this->assertEquals(30, $juros->getDiasJurosMes($dataAtual));

        $dataAtual = new \DateTimeImmutable('2021-04-01');
        $this->assertEquals(30, $juros->getDiasJurosMes($dataAtual));

        $dataAtual = new \DateTimeImmutable('2021-05-01');
        $this->assertEquals(19, $juros->getDiasJurosMes($dataAtual));
    }

    public function test_get_dias_mes2(): void
    {
        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-08'),
            new \DateTimeImmutable('2021-01-20'),
            true
        );
        $dataAtual = new \DateTimeImmutable('2021-01-08');
        $this->assertEquals(12, $juros->getDiasJurosMes($dataAtual));
    }

    public function test_get_indices_por_mes(): void
    {
        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-01'),
            new \DateTimeImmutable('2021-05-31'),
            true
        );
        $this->assertEquals([1, 1, 1, 1, 1], $juros->getIndicesPorMes());

        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-02'),
            new \DateTimeImmutable('2021-05-29'),
            true
        );
        $this->assertEquals([1 / 30 * 29, 1, 1, 1, 1 / 30 * (30 - 2)], $juros->getIndicesPorMes());
    }

    public function test_get_indice_total_juros_simples(): void
    {
        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-01'),
            new \DateTimeImmutable('2021-05-31'),
            false
        );
        $this->assertEquals(1.05, $juros->getIndiceTotal());
    }

    public function test_get_indice_total_juros_composto(): void
    {
        $juros = new Juros(
            1,
            new \DateTimeImmutable('2021-01-01'),
            new \DateTimeImmutable('2021-05-31'),
            true
        );
        $indiceEsperado = 1;
        for ($i = 1; $i <= 5; $i++) {
            $indiceEsperado = $indiceEsperado * 0.01 + $indiceEsperado;
        }
        $this->assertEquals($indiceEsperado, $juros->getIndiceTotal());
    }
}
