<?php

namespace MattA\ApplicationMvcPhp\Controller;

use MattA\ApplicationMvcPhp\Model\Trajet;

class TrajetController
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function liste(): array
    {
        $trajetModel = new Trajet($this->pdo);

        return $trajetModel->getAvailableTrajets();
    }
}
