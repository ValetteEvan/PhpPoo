<?php

require_once 'Creature.php';

class Guerrier extends Creature
{
    public function __construct(string $nom)
    {
        parent::__construct($nom, 150, 20, 10);
    }

    public function crier(): string
    {
        return "Pour la gloire !";
    }
}
