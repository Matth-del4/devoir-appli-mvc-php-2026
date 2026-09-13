<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 600px;">
    <h1 class="mb-4">Modifier le trajet</h1>

    <form method="POST" action="/trajet/<?= $trajet['id_trajet'] ?>/modifier">
        <div class="mb-3">
            <label class="form-label">Agence de départ :</label>
            <select class="form-select" name="agence_depart_id" required>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>" <?= $agence['id_agence'] == $trajet['agence_depart_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence d'arrivée :</label>
            <select class="form-select" name="agence_arrivee_id" required>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>" <?= $agence['id_agence'] == $trajet['agence_arrivee_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date/heure de départ :</label>
            <input type="datetime-local" class="form-control" name="gdh_depart" value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_depart'])) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date/heure d'arrivée :</label>
            <input type="datetime-local" class="form-control" name="gdh_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_arrivee'])) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre de places :</label>
            <input type="number" class="form-control" name="nb_place_total" min="1" max="9" value="<?= $trajet['nb_place_total'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>