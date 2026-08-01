<?php // Dossier accessible au navigateur
require '../vendor/autoload.php'; // Chargement de l'autoloader de Composer

// Utilisation des classes nécessaires
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Création d'une instance de Router
$router = new Router();

// Définition d'une route pour la page d'accueil
$router->get('/', function (Request $request) {
    return new Response('Hello, World!');
});

// Définition d'une route pour une page de test
$router->run();