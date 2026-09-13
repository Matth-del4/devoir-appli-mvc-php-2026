<?php if (!isset($_SESSION['user_id'])) : ?>
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Touche pas au klaxon</span>
            <a href="/connexion" class="btn btn-light">Connexion</a>
        </div>
    </nav>
<?php elseif ($_SESSION['role'] === 'admin') : ?>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/admin" class="navbar-brand">Touche pas au klaxon</a>
            <div>
                <a href="/admin" class="btn btn-outline-light btn-sm me-2">Tableau de bord</a>
                <a href="/deconnexion" class="btn btn-outline-light btn-sm">Déconnexion</a>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Touche pas au klaxon</span>
            <div class="d-flex align-items-center gap-2">
                <a href="/trajet/creer" class="btn btn-light btn-sm">Créer un trajet</a>
                <span class="text-white"><?= htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']) ?></span>
                <a href="/deconnexion" class="btn btn-outline-light btn-sm">Déconnexion</a>
            </div>
        </div>
    </nav>
<?php endif; ?>