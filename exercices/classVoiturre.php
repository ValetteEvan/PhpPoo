<?php

class voiture {
    private $marque;
    private $modele;
    private $couleur;
    private $vitesse = 0;

    public function __construct($marque, $modele, $couleur) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->couleur = $couleur;
    }

    public function accelerer($augmentation) {
        $this->vitesse += $augmentation;
    }

    public function freiner($reduction) {
        $this->vitesse -= $reduction;
        if ($this->vitesse < 0) {
            $this->vitesse = 0;
        }
    }

    public function getVitesse() {
        return $this->vitesse;
    }

    public function getDescription() {
        return "{$this->couleur} {$this->marque} {$this->modele}";
    }
}