<?php

require_once 'Creature.php';
require_once 'Guerrier.php';
require_once 'Mage.php';
require_once 'Archer.php';
require_once 'Arene.php';

$arene = new Arene();

echo "\n";
echo "╔════════════════════════════════════════╗\n";
echo "║   BIENVENUE DANS L'ARÈNE DE COMBAT    ║\n";
echo "╚════════════════════════════════════════╝\n";

echo "\n\n🎮 COMBAT 1 : Guerrier vs Mage\n";
$guerrier1 = new Guerrier("Conan");
$mage1 = new Mage("Gandalf");
$arene->lancerCombat($guerrier1, $mage1);

echo "\n\n" . str_repeat("=", 50) . "\n\n";
sleep(1);

echo "\n\n🎮 COMBAT 2 : Archer vs Guerrier\n";
$archer1 = new Archer("Legolas");
$guerrier2 = new Guerrier("Aragorn");
$arene->lancerCombat($archer1, $guerrier2);

echo "\n\n" . str_repeat("=", 50) . "\n\n";
sleep(1);

echo "\n\n🎮 COMBAT 3 : Mage vs Archer\n";
$mage2 = new Mage("Merlin");
$archer2 = new Archer("Robin");
$arene->lancerCombat($mage2, $archer2);

echo "\n\n";
echo "╔════════════════════════════════════════╗\n";
echo "║   TOUS LES COMBATS SONT TERMINÉS !    ║\n";
echo "╚════════════════════════════════════════╝\n";
echo "\n";
