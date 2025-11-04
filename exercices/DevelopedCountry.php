<?php

require_once 'Country.php';

class DevelopedCountry extends Country
{
    private float $gdp; 


    public function __construct(string $name, string $capital, float $population, string $continent, float $gdp)
    {
        parent::__construct($name, $capital, $population, $continent);
        $this->gdp = $gdp;
    }

    public function getInfo(): string
    {
        return parent::getInfo() . " Son PIB est de {$this->gdp} milliards de dollars.";
    }

    public function getGdp(): float
    {
        return $this->gdp;
    }
    
    public function setGdp(float $gdp): void
    {
        $this->gdp = $gdp;
    }
}
