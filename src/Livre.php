<?php

namespace App;

use \DateTime;

class Livre extends Media
{

    protected string $idbn;
    protected string $auteur;
    protected int $nbPages;

    /**
     * @param string $idbn
     * @param string $auteur
     * @param int $nbPages
     */
    public function __construct(string $idbn, string $titre, string $auteur, int $nbPages)
    {
        parent::__construct($titre, 21);
        $this->idbn = $idbn;
        $this->auteur = $auteur;
        $this->nbPages = $nbPages;
    }


    public function getInformations(): string
    {
        return "Titre : $this->titre".PHP_EOL.
            "ISBN : $this->idbn".PHP_EOL.
            "Auteur : $this->auteur".PHP_EOL.
            "Nombre de pages : $this->nbPages";
    }
}