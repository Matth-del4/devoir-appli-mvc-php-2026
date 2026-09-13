<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 600px;">
    <h1 class="mb-4">Proposer un trajet</h1>

    <form method="POST" action="/trajet/creer">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Nom :</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($utilisateur['nom']) ?>" disabled>
            </div>
            <div class="col">
                <label class="form-label">Prénom :</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence de départ :</label>
            <select class="form-select" name="agence_depart_id" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>"><?= htmlspecialchars($agence['nom_ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence d'arrivée :</label>
            <select class="form-select" name="agence_arrivee_id" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>"><?= htmlspecialchars($agence['nom_ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date/heure de départ :</label>
            <input type="datetime-local" class="form-control" name="gdh_depart" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date/heure d'arrivée :</label>
            <input type="datetime-local" class="form-control" name="gdh_arrivee" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre de places :</label>
            <input type="number" class="form-control" name="nb_place_total" min="1" max="9" required>
        </div>

        <button type="submit" class="btn btn-primary">Proposer ce trajet</button>
    </form>
</div>