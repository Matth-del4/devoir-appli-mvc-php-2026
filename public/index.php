<?php // Dossier accessible au navigateur
require '../vendor/autoload.php'; // Chargement de l'autoloader de Composer
require_once '../config/database.php'; // Chargement de la configuration de la base de données
session_start();

// Utilisation des classes nécessaires
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MattA\ApplicationMvcPhp\Controller\TrajetController;
use MattA\ApplicationMvcPhp\Controller\AuthController;

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

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

$router->get('/connexion', function () {
    ob_start();
    include __DIR__ . '/../src/View/auth/connexion.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});


$router->post('/connexion', function (Request $request) use ($pdo) {
    $controller = new AuthController($pdo);
    $success = $controller->connexion($request);

    if ($success) {
        header('Location: /'); // Redirection vers la page d'accueil après une connexion réussie
        exit();
    } else {
        return new Response('Échec de la connexion. Veuillez vérifier vos identifiants.', 401);
    }
});

// Définition d'une route pour la soumission d'un formulaire
$router->post('/submit', function (Request $request) {
    $data = $request->request->all();
    return new Response("Données reçues : " . json_encode($data));
});

$router->get('/trajet/:id', function ($id) use ($pdo) {
    $controller = new TrajetController($pdo);
    $trajet = $controller->details((int) $id);

    if (!$trajet) {
        return new Response('Trajet introuvable', 404);
    }

    ob_start();
    include __DIR__ . '/../src/View/trajet/details.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

// Lancement du routeur pour traiter la requête entrante
$router->run();