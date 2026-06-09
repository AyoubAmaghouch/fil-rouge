CREATE TABLE agences (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    nom_agence VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    whatsapp VARCHAR(20),
    ville VARCHAR(100) NOT NULL,
    localisation VARCHAR(255),
    mot_de_passe VARCHAR(255) NOT NULL,
    logo VARCHAR(255) NOT NULL,
    statut_validation BOOLEAN DEFAULT 0
);

CREATE TABLE admins (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE marques (
    id_marque INT AUTO_INCREMENT PRIMARY KEY,
    nom_marque VARCHAR(100) NOT NULL
);

CREATE TABLE voitures (
    id_voiture INT AUTO_INCREMENT PRIMARY KEY,
    id_agence INT NOT NULL,
    id_marque INT NOT NULL,
    modele VARCHAR(100) NOT NULL,
    carburant VARCHAR(50) NOT NULL,
    transmission VARCHAR(50) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    disponibilite BOOLEAN NOT NULL,

    FOREIGN KEY (id_agence)
    REFERENCES agences(id_agence),

    FOREIGN KEY (id_marque)
    REFERENCES marques(id_marque)
);

CREATE TABLE images_voitures (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_voiture INT NOT NULL,
    image VARCHAR(255) NOT NULL,

    FOREIGN KEY (id_voiture)
    REFERENCES voitures(id_voiture)
);



INSERT INTO marques (nom_marque) VALUES
('BMW'),
('Audi'),
('Mercedes'),
('Peugeot'),
('Renault'),
('Volkswagen'),
('Toyota'),
('Hyundai');
INSERT INTO admins (email, mot_de_passe)
VALUES (
'ayoubamaghouche@gmail.com',
'$2y$12$2Bw4.PldiPHRk.aYnLEsCeAM42Uv37SJ1zuiDrpD1QBHTw7mZEAM2'
);