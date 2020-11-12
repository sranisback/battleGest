<?php


use App\Entity\Joueur;

class JoueurFactory
{
    public static function creerJoueur($nom)
    {
        $joueur = new Joueur();
        $joueur->setNom($nom);

        return $joueur;
    }
}