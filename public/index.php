<?php // Dossier accessible au navigateur
require '../vendor/autoload.php'; // Chargement de l'autoloader de Composer
require_once '../config/database.php'; // Chargement de la configuration de la base de données

// Utilisation des classes nécessaires
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MattA\ApplicationMvcPhp\Controller\TrajetController;

// Création d'une instance de Router
$router = new Router();

// Définition d'une route pour la page d'accueil
$router->get('/', function () use ($pdo) {
    // Création d'une instance du contrôleur TrajetController
    $controller =new TrajetController ($pdo);
    $trajets = $controller->liste();

    // Inclusion de la vue pour afficher les trajets
    ob_start();
    include __DIR__ . '/../src/View/trajet/liste.php';
    $content = ob_get_clean();

    return new Response($content);
});

// Définition d'une route pour la soumission d'un formulaire
$router->post('/submit', function (Request $request) {
    $data = $request->request->all();
    return new Response("Données reçues : " . json_encode($data));
});

// Lancement du routeur pour traiter la requête entrante
$router->run();