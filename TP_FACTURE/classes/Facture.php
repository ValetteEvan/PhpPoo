<?php

class Facture
{
    private ?int $id;
    private float $montant;
    private string $produits;
    private int $quantite;
    private int $idClient;
    private ?string $dateCreation;

    // Propriétés pour la jointure avec Client
    private ?string $nomClient = null;
    private ?string $prenomClient = null;

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

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;
        return $this;
    }

    public function getProduits(): string
    {
        return $this->produits;
    }

    public function setProduits(string $produits): self
    {
        $this->produits = $produits;
        return $this;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): self
    {
        $this->idClient = $idClient;
        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;
        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;
        return $this;
    }

    public function getNomCompletClient(): ?string
    {
        if ($this->nomClient && $this->prenomClient) {
            return $this->nomClient . ' ' . $this->prenomClient;
        }
        return null;
    }

    public function getMontantFormate(): string
    {
        return number_format($this->montant, 2, ',', ' ') . ' €';
    }

    public function getDateCreationFormatee(): string
    {
        return $this->dateCreation ? date('d/m/Y H:i', strtotime($this->dateCreation)) : '';
    }

    public function getProduitsResume(int $longueur = 50): string
    {
        if (strlen($this->produits) > $longueur) {
            return substr($this->produits, 0, $longueur) . '...';
        }
        return $this->produits;
    }
}
