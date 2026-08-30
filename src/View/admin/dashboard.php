<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Tableau de bord administrateur</h1>

    <h2>Agences</h2>
    <a href="/admin/agences/creer">Ajouter une agence</a>
    <ul>
        <?php foreach ($agences as $agence) : ?>
            <li>
                <?= htmlspecialchars($agence['nom_ville']) ?>
                <a href="/admin/agences/<?= $agence['id_agence'] ?>/modifier">Modifier</a>
                <a href="/admin/agences/<?= $agence['id_agence'] ?>/supprimer">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Utilisateurs</h2>
    <ul>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <li><?= htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?> — <?= htmlspecialchars($utilisateur['email']) ?> (<?= htmlspecialchars($utilisateur['role']) ?>)</li>
        <?php endforeach; ?>
    </ul>

    <h2>Trajets</h2>
    <ul>
        <?php foreach ($trajets as $trajet) : ?>
            <li>
                Trajet #<?= $trajet['id_trajet'] ?> — <?= htmlspecialchars($trajet['gdh_depart']) ?>
                <a href="/admin/trajets/<?= $trajet['id_trajet'] ?>/supprimer">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>