<?php

/**
 * Classe Creature - Représente une créature générique
 */
class Creature
{
    protected string $nom;
    protected int $sante;
    protected int $force;
    protected int $defense;

    /**
     * Constructeur de la créature
     *
     * @param string $nom Le nom de la créature
     * @param int $sante Les points de santé
     * @param int $force La puissance d'attaque
     * @param int $defense La capacité de défense
     */
    public function __construct(string $nom, int $sante, int $force, int $defense)
    {
        $this->nom = $nom;
        $this->sante = $sante;
        $this->force = $force;
        $this->defense = $defense;
    }

    /**
     * Attaque une créature adverse
     *
     * @param Creature $adversaire La créature à attaquer
     */
    public function attaquer(Creature $adversaire): void
    {
        $degats = max(0, $this->force - $adversaire->defense);
        echo "{$this->nom} attaque {$adversaire->nom} et inflige {$degats} dégâts !\n";
        $adversaire->recevoirDegats($degats);
    }

    /**
     * Reçoit des dégâts
     *
     * @param int $degats Les dégâts à recevoir
     */
    public function recevoirDegats(int $degats): void
    {
        $this->sante -= $degats;
        echo "{$this->nom} a maintenant {$this->sante} points de vie.\n";
    }

    /**
     * Vérifie si la créature est en vie
     *
     * @return bool true si en vie, false sinon
     */
    public function estEnVie(): bool
    {
        return $this->sante > 0;
    }

    /**
     * Fait crier la créature
     *
     * @return string Le cri de la créature
     */
    public function crier(): string
    {
        return "Grrrr !";
    }

    /**
     * Getter pour le nom
     *
     * @return string Le nom de la créature
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Getter pour la santé
     *
     * @return int Les points de santé
     */
    public function getSante(): int
    {
        return $this->sante;
    }
}
