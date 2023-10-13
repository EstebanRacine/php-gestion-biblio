<?php

namespace App;

use \DateTime;

class Magazine extends Media
{
    protected int $numero;
    protected DateTime $datePublication;

    /**
     * @param int $numero
     * @param DateTime $datePublication
     */
    public function __construct(string $titre, int $numero, DateTime $datePublication)
    {
        parent::__construct($titre, 10);
        $this->numero = $numero;
        $this->datePublication = $datePublication;
    }


    public function getInformations(): string
    {
        return "Titre : $this->titre".PHP_EOL.
            "Numéro : N°$this->numero".PHP_EOL.
            "Date de publication : ".$this->datePublication->format("d/m/Y");
    }
}