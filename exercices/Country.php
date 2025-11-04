<?php

class Country
{
    private string $name;
    private string $capital;
    private float $population; 
    private string $continent;

    public function __construct(string $name, string $capital, float $population, string $continent)
    {
        $this->name = $name;
        $this->capital = $capital;
        $this->population = $population;
        $this->continent = $continent;
    }

    public function getInfo(): string
    {
        return "Le pays {$this->name} a pour capitale {$this->capital}, " .
               "compte {$this->population} millions d'habitants et se situe en {$this->continent}.";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCapital(): string
    {
        return $this->capital;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function getContinent(): string
    {
        return $this->continent;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCapital(string $capital): void
    {
        $this->capital = $capital;
    }

    public function setPopulation(float $population): void
    {
        $this->population = $population;
    }

    public function setContinent(string $continent): void
    {
        $this->continent = $continent;
    }

    public function isPopulous(): bool
    {
        return $this->population > 100;
    }
}
