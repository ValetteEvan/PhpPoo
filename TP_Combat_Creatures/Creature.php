<?php

class Creature
{
    protected string $nom;
    protected int $sante;
    protected int $force;
    protected int $defense;

    public function __construct(string $nom, int $sante, int $force, int $defense)
    {
        $this->nom = $nom;
        $this->sante = $sante;
        $this->force = $force;
        $this->defense = $defense;
    }

    public function attaquer(Creature $adversaire): void
    {
        $degats = max(0, $this->force - $adversaire->defense);
        echo "{$this->nom} attaque {$adversaire->nom} et inflige {$degats} dégâts !\n";
        $adversaire->recevoirDegats($degats);
    }

    public function recevoirDegats(int $degats): void
    {
        $this->sante -= $degats;
        echo "{$this->nom} a maintenant {$this->sante} points de vie.\n";
    }

    public function estEnVie(): bool
    {
        return $this->sante > 0;
    }

    public function crier(): string
    {
        return "Grrrr !";
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getSante(): int
    {
        return $this->sante;
    }
}
