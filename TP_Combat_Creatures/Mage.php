<?php

require_once 'Creature.php';

class Mage extends Creature
{
    public function __construct(string $nom)
    {
        parent::__construct($nom, 100, 30, 5);
    }

    public function attaquer(Creature $adversaire): void
    {
        $degats = max(0, ($this->force + 10) - $adversaire->defense);
        echo "{$this->nom} lance un sort sur {$adversaire->nom} et inflige {$degats} dégâts magiques !\n";
        $adversaire->recevoirDegats($degats);
    }

    public function crier(): string
    {
        return "Abracadabra !";
    }
}
