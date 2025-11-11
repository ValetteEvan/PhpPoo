
CREATE DATABASE IF NOT EXISTS gestion_factures CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_factures;

CREATE TABLE IF NOT EXISTS CLIENTS (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    sexe ENUM('H', 'F') NOT NULL,
    date_naissance DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS FACTURES (
    id_facture INT AUTO_INCREMENT PRIMARY KEY,
    montant DECIMAL(10, 2) NOT NULL,
    produits TEXT NOT NULL,
    quantite INT NOT NULL,
    id_client INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES CLIENTS(id_client) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO CLIENTS (nom, prenom, sexe, date_naissance) VALUES
('Dupont', 'Jean', 'H', '1985-03-15'),
('Martin', 'Sophie', 'F', '1990-07-22'),
('Bernard', 'Pierre', 'H', '1978-11-30');