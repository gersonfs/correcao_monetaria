<?php

namespace App\Test\TestCase\Dominio\Indice;

use App\Dominio\Indice\AcumularIndices;
use App\Dominio\Indice\Indice;
use App\Dominio\Indice\TipoIndice;
use Cake\TestSuite\TestCase;

class AcumularIndicesTest extends TestCase
{

    public function test_acumular_from_indices(): void
    {
        $service = new AcumularIndices();
        $igpm = TipoIndice::buildIGPM();
        $indices = [
            Indice::buildMes(12, 2020, '0.98', $igpm),
            Indice::buildMes(11, 2020, '3.28', $igpm),
            Indice::buildMes(10, 2020, '3.23', $igpm),
        ];
        $this->assertEquals('1.07661', round($service->acumularFromIndice($indices), 5));
    }

    public function test_acumular_com_negativos(): void
    {
        $service = new AcumularIndices();
         $percentuais = $this->getPercentuais();

        $this->assertEquals('10.13860', round($service->acumular($percentuais), 5));
    }

    /**
     * Retorna o IGPM de 07/1994 até 12/2020
     * @return string[]
     */
    private function getPercentuais(): array
    {
        return ['4.33', '3.94', '1.75', '1.82', '2.85', '0.84', '0.92', '1.39', '1.12', '2.10', '0.58', '2.46', '1.82',
            '2.20', '-0.71', '0.52', '1.20', '0.71', '1.73', '0.97', '0.40', '0.32', '1.55', '1.02', '1.35', '0.28',
            '0.10', '0.19', '0.20', '0.73', '1.77', '0.43', '1.15', '0.68', '0.21', '0.74', '0.09', '0.09', '0.48',
            '0.37', '0.64', '0.84', '0.96', '0.18', '0.19', '0.13', '0.14', '0.38', '-0.17', '-0.16', '-0.08', '0.08',
            '-0.32', '0.45', '0.84', '3.61', '2.83', '0.71', '-0.29', '0.36', '1.55', '1.56', '1.45', '1.70', '2.39',
            '1.81', '1.24', '0.35', '0.15', '0.23', '0.31', '0.85', '1.57', '2.39', '1.16', '0.38', '0.29', '0.63',
            '0.62', '0.23', '0.56', '1.00', '0.86', '0.98', '1.48', '1.38', '0.31', '1.18', '1.10', '0.22', '0.36',
            '0.06', '0.09', '0.56', '0.83', '1.54', '1.95', '2.32', '2.40', '3.87', '5.19', '3.75', '2.33', '2.28',
            '1.53', '0.92', '-0.26', '-1.00', '-0.42', '0.38', '1.18', '0.38', '0.49', '0.61', '0.88', '0.69', '1.13',
            '1.21', '1.31', '1.38', '1.31', '1.22', '0.69', '0.39', '0.82', '0.74', '0.39', '0.30', '0.85', '0.86',
            '-0.22', '-0.44', '-0.34', '-0.65', '-0.53', '0.60', '0.40', '-0.01', '0.92', '0.01', '-0.23', '-0.42',
            '0.38', '0.75', '0.18', '0.37', '0.29', '0.47', '0.75', '0.32', '0.50', '0.27', '0.34', '0.04', '0.04',
            '0.26', '0.28', '0.98', '1.29', '1.05', '0.69', '1.76', '1.09', '0.53', '0.74', '0.69', '1.61', '1.98',
            '1.76', '-0.32', '0.11', '0.98', '0.38', '-0.13', '-0.44', '0.26', '-0.74', '-0.15', '-0.07', '-0.10',
            '-0.43', '-0.36', '0.42', '0.05', '0.10', '-0.26', '0.63', '1.18', '0.94', '0.77', '1.19', '0.85', '0.15',
            '0.77', '1.15', '1.01', '1.45', '0.69', '0.79', '1.00', '0.62', '0.45', '0.43', '-0.18', '-0.12', '0.44',
            '0.65', '0.53', '0.50', '-0.12', '0.25', '-0.06', '0.43', '0.85', '1.02', '0.66', '1.34', '1.43', '0.97',
            '0.02', '-0.03', '0.68', '0.34', '0.29', '0.21', '0.15', '0.00', '0.75', '0.26', '0.15', '1.50', '0.86',
            '0.29', '0.60', '0.48', '0.38', '1.67', '0.78', '-0.13', '-0.74', '-0.61', '-0.27', '0.20', '0.28', '0.98',
            '0.62', '0.76', '0.27', '0.98', '1.17', '0.41', '0.67', '0.69', '0.28', '0.95', '1.89', '1.52', '0.49',
            '1.14', '1.29', '0.51', '0.33', '0.82', '1.69', '0.18', '0.15', '0.20', '0.16', '-0.03', '0.54', '0.64',
            '0.08', '0.01', '-1.10', '-0.93', '-0.67', '-0.72', '0.10', '0.47', '0.20', '0.52', '0.89', '0.76', '0.07',
            '0.64', '0.57', '1.38', '1.87', '0.51', '0.70', '1.52', '0.89', '-0.49', '-1.08', '0.01', '0.88', '1.26',
            '0.92', '0.45', '0.80', '0.40', '-0.67', '-0.01', '0.68', '0.30', '2.09', '0.48', '-0.04', '1.24', '0.80',
            '0.28', '1.56', '2.23', '2.74', '4.34', '3.23', '3.28', '0.98'];
    }
}
