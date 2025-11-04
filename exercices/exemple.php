<?php

$annees = [1985, 1992, 1978, 2001, 1995, 1988, 2003, 1992, 1985, 2010];
echo "Liste des années de naissance : " . implode(", ", $annees) . "\n\n";

$anneePlusPetite = min($annees);
echo "1. L'année de naissance la plus petite : " . $anneePlusPetite . "\n";

$anneePlusGrande = max($annees);
echo "2. L'année de naissance la plus grande : " . $anneePlusGrande . "\n";

$compteurPaires = 0;
foreach ($annees as $annee) {
    if ($annee % 2 == 0) {
        $compteurPaires++;
    }
}
echo "3. Le nombre d'années de naissance paires : " . $compteurPaires . "\n";

?>