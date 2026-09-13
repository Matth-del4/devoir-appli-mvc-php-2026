<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1 class="mb-4">Détails du trajet</h1>

    <div class="card mb-3" style="max-width: 500px;">
        <div class="card-body">
            <p>Départ : agence n°<?= htmlspecialchars($trajet['agence_depart_id']) ?> — <?= htmlspecialchars($trajet['gdh_depart']) ?></p>
            <p>Arrivée : agence n°<?= htmlspecialchars($trajet['agence_arrivee_id']) ?> — <?= htmlspecialchars($trajet['gdh_arrivee']) ?></p>
            <p><span class="badge bg-success"><?= htmlspecialchars($trajet['nb_place_dispo']) ?> / <?= htmlspecialchars($trajet['nb_place_total']) ?> places</span></p>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">
                    Voir les infos de contact
                </button>

                <?php if ($_SESSION['user_id'] == $trajet['id_utilisateur']) : ?>
                    <a href="/trajet/<?= $trajet['id_trajet'] ?>/modifier" class="btn btn-outline-secondary">Modifier</a>
                    <a href="/trajet/<?= $trajet['id_trajet'] ?>/supprimer" class="btn btn-outline-danger">Supprimer</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="modal" id="contactModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nom : <?= htmlspecialchars($trajet['prenom'] . ' ' . $trajet['nom']) ?></p>
                        <p>Téléphone : <?= htmlspecialchars($trajet['telephone']) ?></p>
                        <p>Email : <?= htmlspecialchars($trajet['email']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>