# TP : Combat des Créatures

## Description

Mini-jeu de combat de créatures implémenté en PHP utilisant les concepts de Programmation Orientée Objet (POO).

## Objectifs

- Créer différents types de créatures avec des caractéristiques uniques
- Implémenter un système de combat entre créatures
- Utiliser l'héritage et le polymorphisme en PHP

## Structure du Projet

```
TP_Combat_Creatures/
├── Creature.php       # Classe de base pour toutes les créatures
├── Guerrier.php       # Classe Guerrier (hérite de Creature)
├── Mage.php          # Classe Mage (hérite de Creature)
├── Archer.php        # Classe Archer (hérite de Creature)
├── Arene.php         # Classe gérant les combats
├── jeu1.php          # Fichier de test
└── README.md         # Documentation
```

## Classes Implémentées

### 1. Creature (Classe de base)

**Attributs :**
- `nom` : Le nom de la créature
- `sante` : Points de vie
- `force` : Puissance d'attaque
- `defense` : Capacité de défense

**Méthodes :**
- `attaquer(Creature $adversaire)` : Attaque une créature adverse
- `recevoirDegats(int $degats)` : Reçoit des dégâts
- `estEnVie()` : Vérifie si la créature est en vie
- `crier()` : Retourne le cri de la créature

### 2. Guerrier

- Santé : 150
- Force : 20
- Défense : 10
- Cri : "Pour la gloire !"

### 3. Mage

- Santé : 100
- Force : 30
- Défense : 5
- Cri : "Abracadabra !"
- **Spécial** : Attaques magiques avec +10 dégâts supplémentaires

### 4. Archer

- Santé : 120
- Force : 15
- Défense : 8
- Cri : "Prêt à viser !"
- **Spécial** : 30% de chances d'esquiver une attaque

### 5. Arene

Gère les combats entre deux créatures avec la méthode `lancerCombat(Creature $c1, Creature $c2)`.

## Utilisation

### Lancer le jeu de test

```bash
cd TP_Combat_Creatures
php jeu1.php
```

### Créer votre propre combat

```php
<?php
require_once 'Creature.php';
require_once 'Guerrier.php';
require_once 'Mage.php';
require_once 'Archer.php';
require_once 'Arene.php';

// Créer des créatures
$guerrier = new Guerrier("Conan");
$mage = new Mage("Gandalf");

// Créer une arène
$arene = new Arene();

// Lancer le combat
$arene->lancerCombat($guerrier, $mage);
?>
```

## Concepts POO Utilisés

1. **Encapsulation** : Les attributs sont protégés avec `protected`
2. **Héritage** : Guerrier, Mage et Archer héritent de Creature
3. **Polymorphisme** : Redéfinition des méthodes `crier()`, `attaquer()` et `recevoirDegats()`
4. **Abstraction** : Utilisation d'une classe de base commune

## Fonctionnalités

- Système de combat au tour par tour
- Calcul automatique des dégâts (force - défense)
- Gestion de la vie des créatures
- Annonce du vainqueur
- Capacités spéciales par type de créature
  - Mage : Bonus de dégâts magiques
  - Archer : Capacité d'esquive

## Tests

Le fichier `jeu1.php` contient 3 combats de test :
1. Guerrier vs Mage
2. Archer vs Guerrier
3. Mage vs Archer

## Auteur

Evan Valette

## GitHub Repository

Pour soumettre votre travail :

1. Créez un repository public nommé `formation_poo_VOTRENOM`
2. Ajoutez l'utilisateur `Esaie12` comme collaborateur
3. Pushez votre code

```bash
# Initialiser le repo (si pas déjà fait)
git init

# Ajouter les fichiers du TP
git add TP_Combat_Creatures/

# Créer un commit
git commit -m "TP Combat des créatures - implémentation complète"

# Lier au repository distant
git remote add origin https://github.com/VOTRE_USERNAME/formation_poo_VOTRENOM.git

# Push
git push -u origin main
```
