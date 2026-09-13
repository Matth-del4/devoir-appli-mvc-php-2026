<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container" style="max-width: 400px;">
    <h1 class="mb-4">Modifier une agence</h1>
    <form method="POST" action="/admin/agences/<?= $agence['id_agence'] ?>/modifier">
        <div class="mb-3">
            <label class="form-label">Nom de la ville :</label>
            <input type="text" class="form-control" name="nom_ville" value="<?= htmlspecialchars($agence['nom_ville']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>