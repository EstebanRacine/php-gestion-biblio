<?php

namespace App;

use \DateTime;
use \DateInterval;

class Emprunt
{
    protected Media $media;
    protected Adherent $adherent;
    protected DateTime $dateEmprunt;
    protected DateTime $dateRetourEstimee;
    protected DateTime|null $dateRetour;

    /**
     * @param DateTime $dateEmprunt
     * @param DateTime $dateRetourEstimee
     * @param DateTime $dateRetour
     */
    public function __construct(Adherent $adherent, Media $media, string $dateEmprunt = "now")
    {
        $this->adherent = $adherent;
        $this->media = $media;
        if ($dateEmprunt == "now"){
            $this->dateEmprunt = new DateTime("midnight");
            $copieDateEmprunt = new DateTime("midnight");
        }else{
            $this->dateEmprunt = date_create_from_format("d/m/Y H:i", $dateEmprunt." 00:00");
            $copieDateEmprunt = date_create_from_format("d/m/Y H:i", $dateEmprunt." 00:00");
        }
        $nbJoursEmprunt = $this->media->getDureeEmprunt();
        $this->dateRetourEstimee = $copieDateEmprunt->add(DateInterval::createFromDateString("$nbJoursEmprunt days"));
        $this->dateRetour = null;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

    /**
     * @return Adherent
     */
    public function getAdherent(): Adherent
    {
        return $this->adherent;
    }

    /**
     * @return DateTime
     */
    public function getDateEmprunt(): DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @return DateTime
     */
    public function getDateRetourEstimee(): DateTime
    {
        return $this->dateRetourEstimee;
    }

    /**
     * @return DateTime|null
     */
    public function getDateRetour(): ?DateTime
    {
        return $this->dateRetour;
    }


    /**
     * @param DateTime $dateRetour
     */
    public function setDateRetour(DateTime $dateRetour): void
    {
        $this->dateRetour = $dateRetour;
    }

    public function getInformations() : string{
        $result = "Media emprunté : ".PHP_EOL.PHP_EOL.$this->media->getInformations() .PHP_EOL.PHP_EOL.
            "Adherent emprunteur : ".PHP_EOL.$this->adherent->getInformations().PHP_EOL.PHP_EOL.
            "Date d'emprunt : ".$this->dateEmprunt->format("d/m/Y").PHP_EOL.
            "Date de retour estimée : ".$this->dateRetourEstimee->format("d/m/Y").PHP_EOL;
        if ($this->dateRetour != null){
            $result.= "Date de retour : ".$this->dateRetour->format("d/m/Y");
        }
        return $result;
    }

    public function empruntEnCours():bool{
        if ($this->dateRetour == null){
            return true;
        }
        return false;
    }

    public function empruntEnAlerte():bool{
        $dateDuJour = new DateTime("midnight");
        if($this->empruntEnCours() && $this->dateRetourEstimee->getTimestamp() < $dateDuJour->getTimestamp()){
            return true;
        }
        return false;
    }

    public function dureeMaxDepassee():bool{
        $dateDuJour = new DateTime("midnight");
        if(!$this->empruntEnCours()){
            if($this->dateRetour->getTimestamp() > $this->dateRetourEstimee->getTimestamp()){
                return true;
            }
        }
        return false;
    }


}