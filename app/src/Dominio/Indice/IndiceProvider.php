<?php


namespace App\Dominio\Indice;

use App\Dominio\Indice\TipoIndice;

interface IndiceProvider
{
    public function getIndice(TipoIndice $tipo, \DateTimeImmutable $data): string;
}
