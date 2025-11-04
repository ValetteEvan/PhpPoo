<?php

require_once 'Country.php';
require_once 'DevelopedCountry.php';

echo "=== EXERCICE 2 : Instanciation et affichage ===\n\n";

$france = new Country("France", "Paris", 67, "Europe");
$japon = new Country("Japon", "Tokyo", 125, "Asie");
$bresil = new Country("Brésil", "Brasilia", 215, "Amérique du Sud");
$maroc = new Country("Maroc", "Rabat", 37, "Afrique");

echo $france->getInfo() . "\n";
echo $japon->getInfo() . "\n";
echo $bresil->getInfo() . "\n";
echo $maroc->getInfo() . "\n";

echo "\n=== EXERCICE 3 : Test des getters et setters ===\n\n";

echo "Nom du pays : " . $france->getName() . "\n";
echo "Population initiale : " . $france->getPopulation() . " millions\n";

$france->setPopulation(68);
echo "Population modifiée : " . $france->getPopulation() . " millions\n";

$maroc->setName("Royaume du Maroc");
echo "Nouveau nom : " . $maroc->getName() . "\n";

echo "\n=== EXERCICE 4 : Tableau d'objets ===\n\n";

$countries = [
    new Country("Chine", "Pékin", 1425, "Asie"),
    new Country("Inde", "New Delhi", 1408, "Asie"),
    new Country("États-Unis", "Washington", 331, "Amérique du Nord"),
    new Country("Indonésie", "Jakarta", 273, "Asie"),
    new Country("Pakistan", "Islamabad", 225, "Asie"),
    new Country("Nigéria", "Abuja", 218, "Afrique"),
    new Country("Allemagne", "Berlin", 83, "Europe"),
];

foreach ($countries as $country) {
    echo $country->getInfo() . "\n";
}

echo "\n=== EXERCICE 5 : Classe DevelopedCountry ===\n\n";

$usa = new DevelopedCountry("États-Unis", "Washington", 331, "Amérique du Nord", 25500);
$allemagne = new DevelopedCountry("Allemagne", "Berlin", 83, "Europe", 4300);
$japon_dev = new DevelopedCountry("Japon", "Tokyo", 125, "Asie", 4940);

echo $usa->getInfo() . "\n";
echo $allemagne->getInfo() . "\n";
echo $japon_dev->getInfo() . "\n";

echo "\n=== EXERCICE 6 : Bonus - Pays très peuplés ===\n\n";

function afficherPaysPopuleux(array $pays): void
{
    echo "Pays avec une population supérieure à 100 millions d'habitants :\n";
    foreach ($pays as $country) {
        if ($country->isPopulous()) {
            echo "- {$country->getName()} : {$country->getPopulation()} millions d'habitants\n";
        }
    }
}

$tousPays = [
    new Country("Chine", "Pékin", 1425, "Asie"),
    new Country("Inde", "New Delhi", 1408, "Asie"),
    new Country("États-Unis", "Washington", 331, "Amérique du Nord"),
    new Country("France", "Paris", 67, "Europe"),
    new Country("Indonésie", "Jakarta", 273, "Asie"),
    new Country("Brésil", "Brasilia", 215, "Amérique du Sud"),
    new Country("Pakistan", "Islamabad", 225, "Asie"),
    new Country("Nigéria", "Abuja", 218, "Afrique"),
    new Country("Bangladesh", "Dacca", 169, "Asie"),
    new Country("Russie", "Moscou", 144, "Europe/Asie"),
    new Country("Japon", "Tokyo", 125, "Asie"),
    new Country("Mexique", "Mexico", 128, "Amérique du Nord"),
];

afficherPaysPopuleux($tousPays);
