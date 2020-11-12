<?php


use App\Entity\Mecha;

class MechaFactory
{
    public static function creerMecha($chassis, $modele)
    {
        $mecha = new Mecha();
        $mecha->setChassis($chassis);
        $mecha->setModele($modele);

        return $mecha;
    }
}