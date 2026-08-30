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
    
        /**
     * Crée une nouvelle agence
     * @param string $nomVille
     * @return bool
     */
    public function create(string $nomVille): bool
    {
        $statement = $this->pdo->prepare('INSERT INTO Agence (nom_ville) VALUES (:nom_ville)');
        return $statement->execute(['nom_ville' => $nomVille]);
    }

    /**
     * Met à jour une agence existante
     * @param int $id
     * @param string $nomVille
     * @return bool
     */
    public function update(int $id, string $nomVille): bool
    {
        $statement = $this->pdo->prepare('UPDATE Agence SET nom_ville = :nom_ville WHERE id_agence = :id_agence');
        return $statement->execute(['nom_ville' => $nomVille, 'id_agence' => $id]);
    }

    /**
     * Supprime une agence
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM Agence WHERE id_agence = :id_agence');
        return $statement->execute(['id_agence' => $id]);
    }
}