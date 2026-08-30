<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <h1>Ajouter une agence</h1>
    <form method="POST" action="/admin/agences/creer">
        <label>Nom de la ville :</label>
        <input type="text" name="nom_ville" required>
        <button type="submit">Ajouter</button>
    </form>
</div>