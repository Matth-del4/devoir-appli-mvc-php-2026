<?php

namespace MattA\ApplicationMvcPhp\Model;

// Modèle pour gérer les agences
class Agence
{
    private \PDO $pdo;

    /**
     * Constructeur de la classe Agence
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère toutes les agences de la base de données
     * @return array
     */
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM Agence'); 
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une agence par son ID
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array 
    {
            $statement = $this->pdo->prepare('SELECT * FROM Agence WHERE id_agence = :id_agence'); 
            $statement->execute(['id_agence' => $id]); 
            $result = $statement->fetch(\PDO::FETCH_ASSOC); 
            return $result ?: null;
    }
}