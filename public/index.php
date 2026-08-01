<?php // Dossier accessible au navigateur
require '../vendor/autoload.php'; // Chargement de l'autoloader de Composer
require_once '../config/database.php'; // Chargement de la configuration de la base de données

// Utilisation des classes nécessaires
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Création d'une instance de Router
$router = new Router();

// Définition d'une route pour la page d'accueil
$router->get('/coucou/:string', function ($name) {
    return new Response("Hello, $name!");
});

// Définition d'une route pour la soumission d'un formulaire
$router->post('/submit', function (Request $request) {
    $data = $request->request->all();
    return new Response("Données reçues : " . json_encode($data));
});

// Définition d'une route pour une page de test
$router->run();