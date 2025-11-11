# Formulaire de Gestion des Plaintes avec Base de Données

Application PHP de gestion de plaintes avec stockage en base de données MySQL, utilisant la POO et Bootstrap.

## Structure du Projet

```
Formulaire/
├── config/
│   └── database.php          # Configuration de la base de données
├── classes/
│   ├── Database.php          # Classe singleton pour la connexion PDO
│   └── Plainte.php           # Classe métier pour gérer les plaintes
├── database/
│   └── schema.sql            # Script SQL pour créer la base et la table
├── formulaire_plaintes.php   # Formulaire de soumission
├── liste_plaintes.php        # Page de visualisation des plaintes
└── README.md                 # Documentation

```

## Installation

### 1. Créer la base de données

Exécutez le script SQL pour créer la base de données et la table :

```bash
mysql -u root -p < database/schema.sql
```

Ou importez manuellement le fichier `database/schema.sql` via phpMyAdmin.

### 2. Configurer la connexion

Modifiez le fichier `config/database.php` avec vos paramètres :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'plaintes_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Lancer le serveur PHP

```bash
cd Formulaire
php -S localhost:8001
```

## Utilisation

### Soumettre une plainte

Accédez à : **http://localhost:8001/formulaire_plaintes.php**

Remplissez le formulaire avec :
- Nom complet (obligatoire)
- Email (obligatoire, format validé)
- Sujet (obligatoire)
- Message (obligatoire, minimum 10 caractères)

### Visualiser les plaintes

Accédez à : **http://localhost:8001/liste_plaintes.php**

Cette page affiche toutes les plaintes enregistrées dans un tableau avec :
- ID, Nom, Email, Sujet, Message (tronqué), Date de création
- Tri par date décroissante (les plus récentes en premier)

## Architecture

### Classes

#### Database.php
- Pattern Singleton pour la connexion PDO
- Gestion centralisée de la connexion à la base de données
- Configuration PDO sécurisée (prepared statements, gestion des erreurs)

#### Plainte.php
- Représente une plainte avec ses propriétés (nom, email, sujet, message)
- Méthode `save()` : Enregistre une plainte en base de données
- Méthode `getAll()` : Récupère toutes les plaintes
- Méthode `getById()` : Récupère une plainte par son ID

### Sécurité

- Protection XSS avec `htmlspecialchars()`
- Requêtes préparées PDO (protection SQL injection)
- Validation côté serveur de tous les champs
- Validation du format email avec `filter_var()`

## Base de Données

### Table `plaintes`

| Colonne        | Type          | Description                    |
|----------------|---------------|--------------------------------|
| id             | INT           | Clé primaire auto-incrémentée  |
| nom            | VARCHAR(255)  | Nom complet                    |
| email          | VARCHAR(255)  | Adresse email                  |
| sujet          | VARCHAR(255)  | Sujet de la plainte            |
| message        | TEXT          | Message détaillé               |
| date_creation  | TIMESTAMP     | Date de création (automatique) |

### Index

- `idx_email` : Index sur le champ email
- `idx_date` : Index sur la date de création

## Fonctionnalités

- Formulaire responsive avec Bootstrap 5
- Validation côté serveur complète
- Messages d'erreur détaillés par champ
- Message de succès après enregistrement
- Affichage de toutes les plaintes dans un tableau
- Gestion des erreurs de connexion à la base de données
- Architecture POO claire et maintenable

## Technologies Utilisées

- PHP 8.4
- MySQL
- PDO (PHP Data Objects)
- Bootstrap 5
- HTML5
- POO (Programmation Orientée Objet)

## Auteur

Evan Valette
