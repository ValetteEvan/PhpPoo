<?php

require_once 'Creature.php';

/**
 * Classe Arene - Gère les combats entre créatures
 */
class Arene
{
    /**
     * Lance un combat entre deux créatures
     *
     * @param Creature $c1 La première créature
     * @param Creature $c2 La deuxième créature
     */
    public function lancerCombat(Creature $c1, Creature $c2): void
    {
        echo "\n========================================\n";
        echo "       COMBAT DANS L'ARÈNE !\n";
        echo "========================================\n";
        echo "{$c1->getNom()} VS {$c2->getNom()}\n";
        echo "========================================\n\n";

        // Les créatures crient avant le combat
        echo "{$c1->getNom()} : \"{$c1->crier()}\"\n";
        echo "{$c2->getNom()} : \"{$c2->crier()}\"\n\n";

        echo "--- Le combat commence ! ---\n\n";

        $tour = 1;

        // Le combat continue tant que les deux créatures sont en vie
        while ($c1->estEnVie() && $c2->estEnVie()) {
            echo "=== Tour {$tour} ===\n";

            // C1 attaque si elle est en vie
            if ($c1->estEnVie()) {
                $c1->attaquer($c2);

                // Vérifier si c2 est KO
                if (!$c2->estEnVie()) {
                    echo "\n{$c2->getNom()} est K.O. !\n";
                    break;
                }
            }

            echo "\n";

            // C2 attaque si elle est en vie
            if ($c2->estEnVie()) {
                $c2->attaquer($c1);

                // Vérifier si c1 est KO
                if (!$c1->estEnVie()) {
                    echo "\n{$c1->getNom()} est K.O. !\n";
                    break;
                }
            }

            echo "\n";
            $tour++;
        }

        // Annonce du vainqueur
        echo "\n========================================\n";
        if ($c1->estEnVie()) {
            echo "   🏆 {$c1->getNom()} remporte le combat ! 🏆\n";
        } else {
            echo "   🏆 {$c2->getNom()} remporte le combat ! 🏆\n";
        }
        echo "========================================\n";
    }
}
