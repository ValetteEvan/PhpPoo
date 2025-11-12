<?php

class Client
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private string $sexe;
    private string $dateNaissance;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getSexe(): string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;
        return $this;
    }

    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function getSexeLibelle(): string
    {
        return $this->sexe === 'H' ? 'Homme' : 'Femme';
    }

    public function getDateNaissanceFormatee(): string
    {
        return date('d/m/Y', strtotime($this->dateNaissance));
    }
}
