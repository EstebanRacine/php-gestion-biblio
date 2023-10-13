<?php

use App\Adherent;

require "vendor/autoload.php";



$ad = new Adherent("Esteban", "Racine", "esteban.racine@fpluriel.org", "07/10/2021");

$date1 = new DateTime();
$date2 = new DateTime("midnight");
$date3 = date_create_from_format("d/m/Y H:i", "20/11/2021 00:00");

dump($date1);
dump($date2);
dump($date3);