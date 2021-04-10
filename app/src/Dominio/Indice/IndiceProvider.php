<?php
declare(strict_types=1);

namespace App\Dominio\Indice;

interface IndiceProvider
{
    public function getIndice(TipoIndice $tipo, \DateTimeImmutable $data): string;
}
