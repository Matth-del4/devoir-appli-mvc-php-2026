<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <h1>Modifier une agence</h1>
    <form method="POST" action="/admin/agences/<?= $agence['id_agence'] ?>/modifier">
        <label>Nom de la ville :</label>
        <input type="text" name="nom_ville" value="<?= htmlspecialchars($agence['nom_ville']) ?>" required>
        <button type="submit">Enregistrer</button>
    </form>
</div>