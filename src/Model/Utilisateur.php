<?php

namespace MattA\ApplicationMvcPhp\Model;

class Utilisateur
{
    private \PDO $pdo;

    /**
     * Constructeur de la classe Utilisateur
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère tous les utilisateurs
     * @return array
     */
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM Utilisateur'); 
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur'); 
        $statement->execute(['id_utilisateur' => $id]); 
        $result = $statement->fetch(\PDO::FETCH_ASSOC); 
        return $result ?: null;
    }

    /**
     * Récupère un utilisateur par son email
     * @param string $email
     * @return array|null
     */
    public function getByEmail(string $email): ?array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM Utilisateur WHERE email = :email'); 
        $statement->execute(['email' => $email]); 
        $result = $statement->fetch(\PDO::FETCH_ASSOC); 
        return $result ?: null;
    }
}