<?php

require_once 'Creature.php';

class Archer extends Creature
{
    public function __construct(string $nom)
    {
        parent::__construct($nom, 120, 15, 8);
    }

    public function recevoirDegats(int $degats): void
    {
        $esquive = rand(1, 100) <= 30;

        if ($esquive) {
            echo "{$this->nom} esquive l'attaque ! Aucun dégât reçu.\n";
        } else {
            parent::recevoirDegats($degats);
        }
    }

    public function crier(): string
    {
        return "Prêt à viser !";
    }
}
