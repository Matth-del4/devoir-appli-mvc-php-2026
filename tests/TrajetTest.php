<?php

use PHPUnit\Framework\TestCase;
use MattA\ApplicationMvcPhp\Model\Trajet;

class TrajetTest extends TestCase
{
    private \PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=touche_pas_au_klaxon;charset=utf8mb4', 'root', '');
    }

    public function testCreateTrajet(): void
    {
        $trajetModel = new Trajet($this->pdo);

        $result = $trajetModel->create([
            'gdh_depart' => '2026-12-01 08:00:00',
            'gdh_arrivee' => '2026-12-01 12:00:00',
            'nb_place_total' => 4,
            'nb_place_dispo' => 4,
            'agence_depart_id' => 1,
            'agence_arrivee_id' => 2,
            'utilisateur_id' => 1,
        ]);

        $this->assertTrue($result);
    }

    public function testUpdateTrajet(): void
{
    $trajetModel = new Trajet($this->pdo);

    // On crée d'abord un trajet à modifier
    $trajetModel->create([
        'gdh_depart' => '2026-12-05 08:00:00',
        'gdh_arrivee' => '2026-12-05 12:00:00',
        'nb_place_total' => 4,
        'nb_place_dispo' => 4,
        'agence_depart_id' => 1,
        'agence_arrivee_id' => 2,
        'utilisateur_id' => 1,
    ]);

    $dernierId = $this->pdo->lastInsertId();

    $result = $trajetModel->update((int) $dernierId, [
        'gdh_depart' => '2026-12-05 09:00:00',
        'gdh_arrivee' => '2026-12-05 13:00:00',
        'nb_place_total' => 4,
        'nb_place_dispo' => 3,
        'agence_depart_id' => 1,
        'agence_arrivee_id' => 2,
        'utilisateur_id' => 1,
    ]);

    $this->assertTrue($result);
}

    public function testDeleteTrajet(): void
    {
        $trajetModel = new Trajet($this->pdo);

        $trajetModel->create([
            'gdh_depart' => '2026-12-10 08:00:00',
            'gdh_arrivee' => '2026-12-10 12:00:00',
            'nb_place_total' => 4,
            'nb_place_dispo' => 4,
            'agence_depart_id' => 1,
            'agence_arrivee_id' => 2,
            'utilisateur_id' => 1,
        ]);

        $dernierId = $this->pdo->lastInsertId();

        $result = $trajetModel->delete((int) $dernierId);

        $this->assertTrue($result);
    }
}