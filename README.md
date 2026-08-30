# Touche pas au klaxon

Application de covoiturage inter-sites permettant aux employés de proposer et consulter des trajets partagés entre les différents sites de l'entreprise.

## Prérequis

- XAMPP (PHP 8.2+, MySQL/MariaDB)
- Composer

## Installation

1. Cloner le dépôt : `git clone https://github.com/Matth-del4/devoir-appli-mvc-php-2026.git`
2. Installer les dépendances : `composer install`
3. Créer une base de données MySQL nommée `touche_pas_au_klaxon`
4. Exécuter `database/script.sql` (création des tables)
5. Exécuter `database/alimentation.sql` (jeu d'essai)
6. Copier `config/database.example.php` en `config/database.php` et renseigner vos identifiants MySQL
7. Lancer le serveur : `php -S localhost:8000 index.php` depuis le dossier `public/`
8. Accéder à `http://localhost:8000`

## Comptes de test

**Administrateur**

- Email : alexandre.martin@email.fr
- Mot de passe : password123

**Utilisateur**

- Email : sophie.dubois@email.fr
- Mot de passe : password123

## Tests et qualité de code

- Lancer les tests unitaires : `vendor\bin\phpunit tests`
- Lancer l'analyse statique : `vendor\bin\phpstan analyse`
