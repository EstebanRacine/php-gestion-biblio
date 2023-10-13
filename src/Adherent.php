<?php

namespace App;

use \DateTime;
use \DateInterval;

require "Emprunt.php";

class Adherent{
    protected string $numAdherent;
    protected string $prenom;
    protected string $nom;
    protected string $email;
    protected DateTime $dateAdhesion;

    /**
     * @param int $numAdherent
     * @param string $prenom
     * @param string $nom
     * @param string $email
     * @param DateTime $dateAdhesion
     */
    public function __construct(string $prenom, string $nom, string $email, string $dateAdhesion = "now")
    {
        $this->numAdherent = $this->genererNumero();
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        if ($dateAdhesion == "now"){
            $this->dateAdhesion = new DateTime("midnight");
        }else{
            $this->dateAdhesion = date_create_from_format("d/m/Y H:i", $dateAdhesion." 00:00");
        }
    }

    public function getNumAdherent(): string
    {
        return $this->numAdherent;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDateAdhesion(): DateTime
    {
        return $this->dateAdhesion;
    }


    public function genererNumero():string{
        $result = "AD-";
        for($i = 0; $i<6; $i++){
            $result.= strval(random_int(0, 9));
        }
        return $result;
    }

    public function renouvelerAdhesion():void{
        $this->dateAdhesion->add(date_interval_create_from_date_string('1 year'));
    }

    public function getInformations():string{
        $infos = "Numero d'adherent : $this->numAdherent".PHP_EOL;
        $infos .= "Prenom : $this->prenom".PHP_EOL;
        $infos .= "Nom : $this->nom".PHP_EOL;
        $infos .= "Email : $this->email".PHP_EOL;
        $infos .= "Date d'adhésion : ".$this->dateAdhesion->format("d/m/Y").PHP_EOL;
        return $infos;
    }

    public function adhesionEstValable():bool{
        $dateActuelle = new DateTime("midnight");
        $dateFinAdhesion = $this->dateAdhesion->add(DateInterval::createFromDateString("1 year"));
        if($dateFinAdhesion->getTimestamp() < $dateActuelle->getTimestamp()){
            return false;
        }
        return true;
    }

}