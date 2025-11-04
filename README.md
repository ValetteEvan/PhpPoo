# Environnement PHP - Exercices

Environnement de développement PHP pour vos exercices, avec Bun pour la gestion des scripts.

## Structure du projet

```
PhpPoo/
├── exercices/       # Vos fichiers d'exercices PHP
│   └── exemple.php
├── public/          # Point d'entrée web
│   └── index.php
├── tests/           # Vos tests
├── php.ini          # Configuration PHP
└── package.json     # Scripts Bun
```

## Installation

Assurez-vous d'avoir PHP installé sur votre système:
```bash
php -v
```

## Utilisation

### Démarrer le serveur de développement

Avec Bun:
```bash
bun run dev
```

Ou directement avec PHP:
```bash
php -S localhost:8000 -t public
```

Puis ouvrez votre navigateur sur: http://localhost:8000

### Exécuter un exercice en ligne de commande

```bash
php exercices/exemple.php
```

### Créer un nouvel exercice

1. Créez un nouveau fichier dans le dossier `exercices/`
2. Écrivez votre code PHP
3. Exécutez-le via le navigateur ou en ligne de commande

## Scripts disponibles

- `bun run dev` - Démarre le serveur de développement
- `bun run serve` - Alias pour démarrer le serveur
- `bun run test` - Exécute les tests

## Configuration PHP

Le fichier [php.ini](php.ini) contient la configuration pour le développement:
- Affichage des erreurs activé
- Timezone: Europe/Paris
- Limites mémoire et upload configurées

## Exemple de code

Consultez [exercices/exemple.php](exercices/exemple.php) pour voir des exemples de:
- Variables et types
- Tableaux
- Fonctions
- POO (Classes)
