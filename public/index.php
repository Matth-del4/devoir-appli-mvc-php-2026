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

$router->get('/trajet/creer', function () use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit();
    }

    $utilisateurModel = new \MattA\ApplicationMvcPhp\Model\Utilisateur($pdo);
    $utilisateur = $utilisateurModel->getById($_SESSION['user_id']);

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agences = $agenceModel->getAll();

    ob_start();
    include __DIR__ . '/../src/View/trajet/creer.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

$router->post('/trajet/creer', function (Request $request) use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit();
    }

    $agenceDepart = $request->request->get('agence_depart_id');
    $agenceArrivee = $request->request->get('agence_arrivee_id');
    $gdhDepart = $request->request->get('gdh_depart');
    $gdhArrivee = $request->request->get('gdh_arrivee');
    $nbPlaceTotal = $request->request->get('nb_place_total');

    // Contrôle 1 : agences différentes
    if ($agenceDepart === $agenceArrivee) {
        return new Response("Erreur : l'agence de départ et d'arrivée doivent être différentes.", 400);
    }

    // Contrôle 2 : arrivée après départ
    if ($gdhArrivee <= $gdhDepart) {
        return new Response("Erreur : la date d'arrivée doit être après la date de départ.", 400);
    }

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajetModel->create([
        'gdh_depart' => $gdhDepart,
        'gdh_arrivee' => $gdhArrivee,
        'nb_place_total' => $nbPlaceTotal,
        'nb_place_dispo' => $nbPlaceTotal,
        'agence_depart_id' => $agenceDepart,
        'agence_arrivee_id' => $agenceArrivee,
        'utilisateur_id' => $_SESSION['user_id'],
    ]);

    header('Location: /');
    exit();
});

$router->get('/trajet/:id/supprimer', function ($id) use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit();
    }

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajet = $trajetModel->getById((int) $id);

    if (!$trajet || $trajet['id_utilisateur'] != $_SESSION['user_id']) {
        return new Response('Action non autorisée', 403);
    }

    $trajetModel->delete((int) $id);

    header('Location: /');
    exit();
});

$router->get('/trajet/:id/modifier', function ($id) use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit();
    }

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajet = $trajetModel->getById((int) $id);

    if (!$trajet || $trajet['id_utilisateur'] != $_SESSION['user_id']) {
        return new Response('Action non autorisée', 403);
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agences = $agenceModel->getAll();

    ob_start();
    include __DIR__ . '/../src/View/trajet/modifier.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

$router->post('/trajet/:id/modifier', function (Request $request, $id) use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit();
    }

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajetExistant = $trajetModel->getById((int) $id);

    if (!$trajetExistant || $trajetExistant['id_utilisateur'] != $_SESSION['user_id']) {
        return new Response('Action non autorisée', 403);
    }

    $agenceDepart = $request->request->get('agence_depart_id');
    $agenceArrivee = $request->request->get('agence_arrivee_id');
    $gdhDepart = $request->request->get('gdh_depart');
    $gdhArrivee = $request->request->get('gdh_arrivee');
    $nbPlaceTotal = $request->request->get('nb_place_total');

    if ($agenceDepart === $agenceArrivee) {
        return new Response("Erreur : agences identiques.", 400);
    }
    if ($gdhArrivee <= $gdhDepart) {
        return new Response("Erreur : date incohérente.", 400);
    }

    $trajetModel->update((int) $id, [
        'gdh_depart' => $gdhDepart,
        'gdh_arrivee' => $gdhArrivee,
        'nb_place_total' => $nbPlaceTotal,
        'nb_place_dispo' => $nbPlaceTotal,
        'agence_depart_id' => $agenceDepart,
        'agence_arrivee_id' => $agenceArrivee,
        'utilisateur_id' => $_SESSION['user_id'],
    ]);

    header('Location: /');
    exit();
});

$router->get('/admin', function () use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agences = $agenceModel->getAll();

    $utilisateurModel = new \MattA\ApplicationMvcPhp\Model\Utilisateur($pdo);
    $utilisateurs = $utilisateurModel->getAll();

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajets = $trajetModel->getAll();

    ob_start();
    include __DIR__ . '/../src/View/admin/dashboard.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

// Créer une agence — affichage formulaire
$router->get('/admin/agences/creer', function () use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    ob_start();
    include __DIR__ . '/../src/View/admin/agence_creer.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

// Créer une agence — traitement
$router->post('/admin/agences/creer', function (Request $request) use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agenceModel->create($request->request->get('nom_ville'));

    header('Location: /admin');
    exit();
});

// Modifier une agence — affichage formulaire
$router->get('/admin/agences/:id/modifier', function ($id) use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agence = $agenceModel->getById((int) $id);

    ob_start();
    include __DIR__ . '/../src/View/admin/agence_modifier.php';
    $content = ob_get_clean();

    ob_start();
    include __DIR__ . '/../src/View/layout/layout.php';
    $page = ob_get_clean();

    return new Response($page);
});

// Modifier une agence — traitement
$router->post('/admin/agences/:id/modifier', function (Request $request, $id) use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agenceModel->update((int) $id, $request->request->get('nom_ville'));

    header('Location: /admin');
    exit();
});

// Supprimer une agence
$router->get('/admin/agences/:id/supprimer', function ($id) use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $agenceModel = new \MattA\ApplicationMvcPhp\Model\Agence($pdo);
    $agenceModel->delete((int) $id);

    header('Location: /admin');
    exit();
});

$router->get('/admin/trajets/:id/supprimer', function ($id) use ($pdo) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /connexion');
        exit();
    }

    $trajetModel = new \MattA\ApplicationMvcPhp\Model\Trajet($pdo);
    $trajetModel->delete((int) $id);

    header('Location: /admin');
    exit();
});

// Lancement du routeur pour traiter la requête entrante
$router->run();