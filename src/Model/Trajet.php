<?php

namespace MattA\ApplicationMvcPhp\Model;

class Trajet
{
    private \PDO $pdo;

    /**
     * Constructeur de la classe Trajet
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère tous les trajets
     * @return array
     */
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM Trajet'); 
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un trajet par son ID
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM Trajet WHERE id_trajet = :id_trajet'); 
        $statement->execute(['id_trajet' => $id]); 
        $result = $statement->fetch(\PDO::FETCH_ASSOC); 
        return $result ?: null;
    }

    /**
     * Récupère les trajets disponibles
     * @return array
     */
    public function getAvailableTrajets(): array
    {
        $statement = $this->pdo->query('SELECT * FROM Trajet WHERE nb_place_dispo > 0 AND gdh_depart > NOW() ORDER BY gdh_depart ASC');
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau trajet
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $statement = $this->pdo->prepare('INSERT INTO Trajet (gdh_depart, gdh_arrivee, nb_place_total, nb_place_dispo, 
agence_depart_id, agence_arrivee_id, utilisateur_id) VALUES (:gdh_depart, :gdh_arrivee, :nb_place_total, :nb_place_dispo, :agence_depart_id, :agence_arrivee_id, :utilisateur_id)');
        return $statement->execute($data);
    }

    /**
     * Met à jour un trajet existant
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $data['id_trajet'] = $id;
        $statement = $this->pdo->prepare('UPDATE Trajet SET gdh_depart = :gdh_depart, gdh_arrivee = :gdh_arrivee, nb_place_total = :nb_place_total, nb_place_dispo = :nb_place_dispo, agence_depart_id = :agence_depart_id, agence_arrivee_id = :agence_arrivee_id, utilisateur_id = :utilisateur_id WHERE id_trajet = :id_trajet');
        return $statement->execute($data);
    }

    /**
     * Supprime un trajet
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM Trajet WHERE id_trajet = :id_trajet');
        return $statement->execute(['id_trajet' => $id]);
    }
}