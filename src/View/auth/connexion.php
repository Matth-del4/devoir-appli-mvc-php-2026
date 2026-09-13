<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="max-width: 400px;">
    <h1 class="mb-4">Connexion</h1>
    <form method="POST" action="/connexion">
        <div class="mb-3">
            <label class="form-label">Email :</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>