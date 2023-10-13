<?php

namespace App\Tests;

use App\Bluray;
use App\Emprunt;
use App\Livre;
use App\Magazine;
use PHPUnit\Framework\TestCase;
use \DateTime;

class EmpruntTest extends TestCase{
    /**
     * @test
     */
    public function __construct_SansDateEmprunt_DateDuJour(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Livre("14", "Harry Potter et la chambre des secrets", "J.K.Rowling", 432);
        $emprunt = new Emprunt($adherent, $media);

        $this->assertEquals(new DateTime("midnight"), $emprunt->getDateEmprunt());
    }

    /**
     * @test
     */
    public function __contruct_DateRetourEstimeePourLivre_DateEmpruntPlus21(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Livre("14", "Harry Potter et la chambre des secrets", "J.K.Rowling", 432);
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $this->assertEquals("22/01/2009", $emprunt->getDateRetourEstimee()->format("d/m/Y"));
    }

    /**
     * @test
     */
    public function __contruct_DateRetourEstimeePourBluRay_DateEmpruntPlus15(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Bluray("Inception", "Nolan", 2010, "2h28");
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $this->assertEquals("16/01/2009", $emprunt->getDateRetourEstimee()->format("d/m/Y"));
    }

    /**
     * @test
     */
    public function __contruct_DateRetourEstimeePourMagazine_DateEmpruntPlus10(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Magazine("Okapi", 5, DateTime::createFromFormat("d/m/Y", "28/11/2011"));
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $this->assertEquals("11/01/2009", $emprunt->getDateRetourEstimee()->format("d/m/Y"));
    }

    /**
     * @test
     */
    public function empruntEnCours_PasDeDateRetour_True(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Magazine("Okapi", 5, DateTime::createFromFormat("d/m/Y", "28/11/2011"));
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $this->assertTrue($emprunt->empruntEnCours());
    }

    /**
     * @test
     */
    public function empruntEnAlerte_DateRetourEstimeeDepasseeEtEmpruntEnCours_True(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Magazine("Okapi", 5, DateTime::createFromFormat("d/m/Y", "28/11/2011"));
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $this->assertTrue($emprunt->empruntEnAlerte());
    }

    /**
     * @test
     */
    public function dureeMaxDepassee_DateRetourPosterieureADateRetourEstimee_True(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");
        $media = new Magazine("Okapi", 5, DateTime::createFromFormat("d/m/Y", "28/11/2011"));
        $emprunt = new Emprunt($adherent, $media, "01/01/2009");
        $emprunt->setDateRetour(DateTime::createFromFormat("d/m/Y H:i", "12/01/2009 00:00"));
        $this->assertTrue($emprunt->dureeMaxDepassee());
    }
}