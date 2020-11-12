<?php


use App\Entity\Pilot;

class PiloteFactory
{
    static function creerPilote($nom, $gunnery, $pilotage, $mecha)
    {
        $pilote = new Pilot();
        $pilote->setNom($nom);
        $pilote->setGunnery($gunnery);
        $pilote->setPiloting($pilotage);
        $pilote->setMecha($mecha);

        return $pilote;
    }
}