<?php if (!isset($_SESSION['user_id'])) : ?>
    <header>
        <p>Touche pas au klaxon</p>
        <a href="/connexion">Connexion</a>
    </header>
<?php elseif ($_SESSION['role'] === 'admin') : ?>
    <header>
        <a href="/admin">Touche pas au klaxon</a>
        <nav>
            <a href="/admin">tableau de bord</a>       
            <a href="/deconnexion">Déconnexion</a>
        </nav>
    </header>
<?php else : ?>
    <header>
        <p>Touche pas au klaxon</p>
        <nav>
            <a href="/trajet/creer">Créer un trajet</a>
            <a href="/deconnexion">Déconnexion</a>
        </nav>
    </header>
<?php endif; ?>