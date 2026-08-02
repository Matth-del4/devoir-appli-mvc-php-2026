<?php

namespace MattA\ApplicationMvcPhp\Controller;

use MattA\ApplicationMvcPhp\Model\Utilisateur;
use Symfony\Component\HttpFoundation\Request;

class AuthController
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function connexion(Request $request)
    {
        session_start();

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $utilisateurModel = new Utilisateur($this->pdo);
        $utilisateur = $utilisateurModel->getByEmail($email);
        
        if ($utilisateur && password_verify($password, $utilisateur['mot_de_passe_hash'])) {
            $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
            $_SESSION['role'] = $utilisateur['role'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['nom'] = $utilisateur['nom'];
            return true;
        } else {
            return false;
        }
    }
}