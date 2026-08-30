<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Modifier le trajet</h1>

    <form method="POST" action="/trajet/<?= $trajet['id_trajet'] ?>/modifier">
        <div>
            <label>Nom :</label>
            <input type="text" value="<?= htmlspecialchars($_SESSION['nom']) ?>" disabled>
        </div>
        <div>
            <label>Prenom :</label>
            <input type="text" value="<?= htmlspecialchars($_SESSION['prenom']) ?>" disabled>
        </div>

        <div>
            <label>Agence de depart :</label>
            <select name="agence_depart_id" required>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>" <?= $agence['id_agence'] == $trajet['agence_depart_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Agence arrivee :</label>
            <select name="agence_arrivee_id" required>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>" <?= $agence['id_agence'] == $trajet['agence_arrivee_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Date heure depart :</label>
            <input type="datetime-local" name="gdh_depart" value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_depart'])) ?>" required>
        </div>

        <div>
            <label>Date heure arrivee :</label>
            <input type="datetime-local" name="gdh_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_arrivee'])) ?>" required>
        </div>

        <div>
            <label>Nombre de places :</label>
            <input type="number" name="nb_place_total" min="1" max="9" value="<?= $trajet['nb_place_total'] ?>" required>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>