<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use \DateTime;

class AdherentTest extends TestCase{
    /**
     * @test
     */
    public function __construct_SansDateAdhesion_DateAujourdhui()
    {
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org");

        $this->assertEquals(new DateTime("midnight"), $adherent->getDateAdhesion());
    }

    /**
     * @test
     */
    public function __construct_AvecDateAdhesion_DateDemandee(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "20/07/2023");
        $dateDemandee = new DateTime();
        $dateDemandee->setDate(2023, 7, 20);
        $dateDemandee->setTime(0, 0);
        $this->assertEquals($dateDemandee, $adherent->getDateAdhesion());
    }

    /**
     * @test
     */
    public function __construct_GenerationNumeroAdherent_NumeroConformeAuFormat(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "20/07/2023");

        $this->assertStringStartsWith('AD-', $adherent->getNumAdherent());
        $this->assertStringMatchesFormat('%d', substr($adherent->getNumAdherent(), -6, 6));
        $this->assertEquals(9, strlen($adherent->getNumAdherent()));
    }

    /**
     * @test
     */
    public function adhesionEstValable_DateNonDepassee_True(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "20/07/2023");

        $this->assertTrue($adherent->adhesionEstValable());
    }

    /**
     * @test
     */
    public function adhesionEstValable_DateDepassee_False(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "10/10/2022");

        $this->assertFalse($adherent->adhesionEstValable());
    }

    /**
     * @test
     */
    public function renouvelerAdhesion_AnneeAdhesionPlus1(){
        $adherent = new \App\Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "10/10/2022");
        $adherent->renouvelerAdhesion();
        $this->assertEquals("10/10/2023", $adherent->getDateAdhesion()->format("d/m/Y"));
    }
}