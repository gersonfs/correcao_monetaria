<?php
declare(strict_types=1);

namespace App\Test\TestCase\Dominio\AtualizacaoMonetaria\Parcela;

use App\Dominio\AtualizacaoMonetaria\Parcela\IndiceMensal;
use App\Dominio\Indice\TipoIndice;
use PHPUnit\Framework\TestCase;

class IndiceMensalTest extends TestCase
{
    public function test_get_indice_com_pro_rata_inicio(): void
    {
        $indiceMensal = new IndiceMensal(
            TipoIndice::buildIGPM(),
            new \DateTimeImmutable('2021-04-01'),
            new \DateTimeImmutable('2021-04-14'),
            '1',
            true
        );
        $indiceDiario = 1 / 30;
        $this->assertEquals($indiceDiario * 14, $indiceMensal->getIndice());
    }

    public function test_get_indice_com_pro_rata_inicio2(): void
    {
        $indiceMensal = new IndiceMensal(
            TipoIndice::buildIGPM(),
            new \DateTimeImmutable('2021-04-05'),
            new \DateTimeImmutable('2021-04-14'),
            '1',
            true
        );
        $indiceDiario = 1 / 30;
        $this->assertEquals($indiceDiario * 10, $indiceMensal->getIndice());
    }

    public function test_get_indice_com_pro_rata_fim(): void
    {
        $indiceMensal = new IndiceMensal(
            TipoIndice::buildIGPM(),
            new \DateTimeImmutable('2021-04-14'),
            new \DateTimeImmutable('2021-04-30'),
            '1',
            true
        );
        $indiceDiario = 1 / 30;
        $this->assertEquals($indiceDiario * 17, $indiceMensal->getIndice());
    }

    public function test_get_indice_com_pro_rata_mes_cheio(): void
    {
        $indiceMensal = new IndiceMensal(
            TipoIndice::buildIGPM(),
            new \DateTimeImmutable('2021-04-01'),
            new \DateTimeImmutable('2021-04-30'),
            '1',
            true
        );
        $this->assertEquals(1, $indiceMensal->getIndice());
    }

    public function test_get_indice_sem_pro_rata_fim(): void
    {
        $indiceMensal = new IndiceMensal(
            TipoIndice::buildIGPM(),
            new \DateTimeImmutable('2021-04-14'),
            new \DateTimeImmutable('2021-04-30'),
            '1',
            false
        );
        $this->assertEquals(1, $indiceMensal->getIndice());
    }
}
