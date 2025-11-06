<?php

require_once 'Creature.php';

/**
 * Classe Archer - Un archer agile avec une capacité d'esquive
 */
class Archer extends Creature
{
    /**
     * Constructeur de l'Archer
     *
     * @param string $nom Le nom de l'archer
     */
    public function __construct(string $nom)
    {
        parent::__construct($nom, 120, 15, 8);
    }

    /**
     * Reçoit des dégâts avec possibilité d'esquive (30% de chances)
     *
     * @param int $degats Les dégâts à recevoir
     */
    public function recevoirDegats(int $degats): void
    {
        // 30% de chances d'esquiver
        $esquive = rand(1, 100) <= 30;

        if ($esquive) {
            echo "{$this->nom} esquive l'attaque ! Aucun dégât reçu.\n";
        } else {
            parent::recevoirDegats($degats);
        }
    }

    /**
     * Cri de l'archer
     *
     * @return string Le cri de l'archer
     */
    public function crier(): string
    {
        return "Prêt à viser !";
    }
}
