<?php include __DIR__ . '/../layout/header.php'; ?>

<?php foreach ($trajets as $trajet) : ?>
    <div class="trajet">
        <h2><?php echo htmlspecialchars($trajet['id_trajet']); ?></h2>
        <p>Départ: agence n° <?php echo htmlspecialchars($trajet['agence_depart_id']); ?></p>
        <p>Arrivée: agence n° <?php echo htmlspecialchars($trajet['agence_arrivee_id']); ?></p>
        <p>Places disponibles: <?php echo htmlspecialchars($trajet['nb_place_dispo']); ?></p>
    </div>
<?php endforeach; ?>