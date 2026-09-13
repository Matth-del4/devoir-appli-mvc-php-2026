<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1 class="mb-4">Tableau de bord administrateur</h1>

    <h2 class="h4 mt-4">Agences</h2>
    <a href="/admin/agences/creer" class="btn btn-primary btn-sm mb-2">Ajouter une agence</a>
    <table class="table table-striped">
        <?php foreach ($agences as $agence) : ?>
            <tr>
                <td><?= htmlspecialchars($agence['nom_ville']) ?></td>
                <td class="text-end">
                    <a href="/admin/agences/<?= $agence['id_agence'] ?>/modifier" class="btn btn-outline-secondary btn-sm">Modifier</a>
                    <a href="/admin/agences/<?= $agence['id_agence'] ?>/supprimer" class="btn btn-outline-danger btn-sm">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2 class="h4 mt-4">Utilisateurs</h2>
    <table class="table table-striped">
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?></td>
                <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                <td><span class="badge bg-secondary"><?= htmlspecialchars($utilisateur['role']) ?></span></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2 class="h4 mt-4">Trajets</h2>
    <table class="table table-striped">
        <?php foreach ($trajets as $trajet) : ?>
            <tr>
                <td>Trajet #<?= $trajet['id_trajet'] ?> — <?= htmlspecialchars($trajet['gdh_depart']) ?></td>
                <td class="text-end">
                    <a href="/admin/trajets/<?= $trajet['id_trajet'] ?>/supprimer" class="btn btn-outline-danger btn-sm">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>