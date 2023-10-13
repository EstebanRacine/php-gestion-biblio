<?php

namespace App;

use \DateTime;

abstract class Media
{
    protected string $titre;
    protected int $dureeEmprunt;

    /**
     * @param string $titre
     * @param int $dureeEmprunt
     */
    public function __construct(string $titre, int $dureeEmprunt)
    {
        $this->titre = $titre;
        $this->dureeEmprunt = $dureeEmprunt;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return int
     */
    public function getDureeEmprunt(): int
    {
        return $this->dureeEmprunt;
    }


    abstract public function getInformations():string;


}