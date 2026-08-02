CREATE TABLE Utilisateur
(
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(254) UNIQUE NOT NULL,
    telephone VARCHAR(20),
    mot_de_passe_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employe') NOT NULL DEFAULT 'employe'
);

CREATE TABLE Agence 
(
    id_agence INT PRIMARY KEY AUTO_INCREMENT,
    nom_ville VARCHAR(100) UNIQUE NOT NULL
    
);

CREATE TABLE Trajet 
(
    id_trajet INT PRIMARY KEY AUTO_INCREMENT,
    gdh_depart DATETIME,
    gdh_arrivee DATETIME,
    nb_place_total TINYINT UNSIGNED,
    nb_place_dispo TINYINT UNSIGNED,
    agence_depart_id INT,
    agence_arrivee_id INT,
    utilisateur_id INT,
    FOREIGN KEY (agence_depart_id) REFERENCES Agence(id_agence),
    FOREIGN KEY (agence_arrivee_id) REFERENCES Agence(id_agence),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id_utilisateur)
);