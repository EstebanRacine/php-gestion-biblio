<?php

namespace App;

use \DateTime;

class Bluray extends Media
{
    protected string $realisateur;
    protected int $annee;
    protected string $duree;

    /**
     * @param string $realisateur
     * @param int $annee
     * @param string $duree
     */
    public function __construct(string $titre, string $realisateur, int $annee, string $duree)
    {
        parent::__construct($titre, 15);
        $this->realisateur = $realisateur;
        $this->annee = $annee;
        $this->duree = $duree;
    }


    public function getInformations(): string
    {
        return "Titre : $this->titre".PHP_EOL.
            "Realisateur : $this->realisateur".PHP_EOL.
            "Année de sortie : $this->annee".PHP_EOL.
            "Durée : $this->dureeEmprunt";
    }
}