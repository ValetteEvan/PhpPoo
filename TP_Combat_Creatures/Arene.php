<?php

require_once 'Creature.php';

class Arene
{
    public function lancerCombat(Creature $c1, Creature $c2): void
    {
        echo "\n========================================\n";
        echo "       COMBAT DANS L'ARÈNE !\n";
        echo "========================================\n";
        echo "{$c1->getNom()} VS {$c2->getNom()}\n";
        echo "========================================\n\n";

        echo "{$c1->getNom()} : \"{$c1->crier()}\"\n";
        echo "{$c2->getNom()} : \"{$c2->crier()}\"\n\n";

        echo "--- Le combat commence ! ---\n\n";

        $tour = 1;

        while ($c1->estEnVie() && $c2->estEnVie()) {
            echo "=== Tour {$tour} ===\n";

            if ($c1->estEnVie()) {
                $c1->attaquer($c2);

                if (!$c2->estEnVie()) {
                    echo "\n{$c2->getNom()} est K.O. !\n";
                    break;
                }
            }

            echo "\n";

            if ($c2->estEnVie()) {
                $c2->attaquer($c1);

                if (!$c1->estEnVie()) {
                    echo "\n{$c1->getNom()} est K.O. !\n";
                    break;
                }
            }

            echo "\n";
            $tour++;
        }

        echo "\n========================================\n";
        if ($c1->estEnVie()) {
            echo "   🏆 {$c1->getNom()} remporte le combat ! 🏆\n";
        } else {
            echo "   🏆 {$c2->getNom()} remporte le combat ! 🏆\n";
        }
        echo "========================================\n";
    }
}
