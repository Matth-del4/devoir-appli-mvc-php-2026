<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Proposer un trajet</h1>

    <form method="POST" action="/trajet/creer">
        <div>
            <label>Nom :</label>
            <input type="text" value="<?= htmlspecialchars($utilisateur['nom']) ?>" disabled>
        </div>
        <div>
            <label>Prenom :</label>
            <input type="text" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" disabled>
        </div>
        <div>
            <label>Email :</label>
            <input type="text" value="<?= htmlspecialchars($utilisateur['email']) ?>" disabled>
        </div>
        <div>
            <label>Telephone :</label>
            <input type="text" value="<?= htmlspecialchars($utilisateur['telephone']) ?>" disabled>
        </div>

        <div>
            <label>Agence de depart :</label>
            <select name="agence_depart_id" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>"><?= htmlspecialchars($agence['nom_ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Agence arrivee :</label>
            <select name="agence_arrivee_id" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?= $agence['id_agence'] ?>"><?= htmlspecialchars($agence['nom_ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Date heure depart :</label>
            <input type="datetime-local" name="gdh_depart" required>
        </div>

        <div>
            <label>Date heure arrivee :</label>
            <input type="datetime-local" name="gdh_arrivee" required>
        </div>

        <div>
            <label>Nombre de places :</label>
            <input type="number" name="nb_place_total" min="1" max="9" required>
        </div>

        <button type="submit">Proposer ce trajet</button>
    </form>
</div>