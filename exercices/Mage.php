<?php

require_once 'Creature.php';

/**
 * Classe Mage - Un mage puissant avec des attaques magiques renforcées
 */
class Mage extends Creature
{
    /**
     * Constructeur du Mage
     *
     * @param string $nom Le nom du mage
     */
    public function __construct(string $nom)
    {
        parent::__construct($nom, 100, 30, 5);
    }

    /**
     * Attaque magique avec dégâts supplémentaires
     *
     * @param Creature $adversaire La créature à attaquer
     */
    public function attaquer(Creature $adversaire): void
    {
        // Dégâts de base + bonus magique de +10
        $degats = max(0, ($this->force + 10) - $adversaire->defense);
        echo "{$this->nom} lance un sort sur {$adversaire->nom} et inflige {$degats} dégâts magiques !\n";
        $adversaire->recevoirDegats($degats);
    }

    /**
     * Cri du mage
     *
     * @return string Le cri du mage
     */
    public function crier(): string
    {
        return "Abracadabra !";
    }
}
