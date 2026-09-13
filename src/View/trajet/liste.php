<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1 class="mb-4">Trajets disponibles</h1>

    <?php if (empty($trajets)) : ?>
        <p class="text-muted">Aucun trajet disponible pour le moment.</p>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 g-3">
        <?php foreach ($trajets as $trajet) : ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Agence n°<?= htmlspecialchars($trajet['agence_depart_id']) ?> → Agence n°<?= htmlspecialchars($trajet['agence_arrivee_id']) ?></h5>
                        <p class="card-text">
                            Départ : <?= htmlspecialchars($trajet['gdh_depart']) ?><br>
                            Arrivée : <?= htmlspecialchars($trajet['gdh_arrivee']) ?><br>
                            <span class="badge bg-success"><?= htmlspecialchars($trajet['nb_place_dispo']) ?> place(s) disponible(s)</span>
                        </p>
                        <a href="/trajet/<?= $trajet['id_trajet'] ?>" class="btn btn-primary btn-sm">Voir le détail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>