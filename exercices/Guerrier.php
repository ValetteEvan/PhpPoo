<?php

require_once 'Creature.php';

/**
 * Classe Guerrier - Un guerrier puissant avec une bonne défense
 */
class Guerrier extends Creature
{
    /**
     * Constructeur du Guerrier
     *
     * @param string $nom Le nom du guerrier
     */
    public function __construct(string $nom)
    {
        parent::__construct($nom, 150, 20, 10);
    }

    /**
     * Cri du guerrier
     *
     * @return string Le cri du guerrier
     */
    public function crier(): string
    {
        return "Pour la gloire !";
    }
}
