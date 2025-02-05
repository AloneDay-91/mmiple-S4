<?php

namespace App\Event;

use App\Entity\Jeu;

class JeuEvent
{
    const ADDED = 'jeu.added';
    const UPDATED = 'jeu.updated';

    private Jeu $jeu;

    public function __construct(Jeu $jeu)
    {
        $this->jeu = $jeu;
    }
    public function getJeu()
    {
        return $this->jeu;
    }
}
