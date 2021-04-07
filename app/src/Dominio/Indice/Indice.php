<?php


namespace App\Dominio\Indice;


class Indice
{
    private \DateTime $inicio;
    private \DateTime $fim;
    private string $percentual;
    private TipoIndice $tipoIndice;

    public function __construct(\DateTime $inicio, \DateTime $fim, string $percentual, TipoIndice $indice)
    {
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->percentual = $percentual;
        $this->tipoIndice = $indice;
    }

    public static function buildMes(int $mes, int $ano, string $percentual, TipoIndice $tipoIndice): self
    {
        $inicio = new \DateTime("{$ano}-{$mes}-01 00:00:00");
        $numeroDias = $inicio->format('t');
        $fim = new \DateTime("{$ano}-{$mes}-{$numeroDias} 00:00:00");
        return new self($inicio, $fim, $percentual, $tipoIndice);
    }

    public function getPercentual(): string
    {
        return $this->percentual;
    }

    public function getFator(): string
    {
        return (string)((float)$this->percentual / 100);
    }

}
