DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Objet;
DROP TABLE IF EXISTS Categorie;
DROP TABLE IF EXISTS Echange;


CREATE TABLE Utilisateur (
idUser INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomUser VARCHAR(255) NOT NULL,
prenomUser VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
estAdmin INT NOT NULL DEFAULT 0);

CREATE TABLE Objet (
idObjet INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
description  TEXT NOT NULL,
nomObjet VARCHAR(255) NOT NULL,
categorie INT NOT NULL,
prixEstimatif DECIMAL(18,5) NOT NULL,
photos TEXT NOT NULL,
idUser INT NOT NULL);

CREATE TABLE Categorie (
idCategorie INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomCategorie VARCHAR(255) NOT NULL);

CREATE TABLE Echange (
idEchange INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
echangeur INT NOT NULL,
receveur INT NOT NULL,
echangeurUser INT NOT NULL,
reveceurUser INT NOT NULL,
etat INT NOT NULL DEFAULT 0,
dateEchange TIMESTAMP);

ALTER TABLE Objet ADD CONSTRAINT Objet_categorie_Categorie_idCategorie FOREIGN KEY (categorie) REFERENCES Categorie(idCategorie);
ALTER TABLE Objet ADD CONSTRAINT Objet_idUser_Utilisateur_idUser FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser);
ALTER TABLE Echange ADD CONSTRAINT Echange_echangeur_Objet_idObjet FOREIGN KEY (echangeur) REFERENCES Objet(idObjet);
ALTER TABLE Echange ADD CONSTRAINT Echange_receveur_Objet_idObjet FOREIGN KEY (receveur) REFERENCES Objet(idObjet);
ALTER TABLE Echange ADD CONSTRAINT Echange_echangeur_Objet_idUser FOREIGN KEY (echangeurUser) REFERENCES Utilisateur(idUser);
ALTER TABLE Echange ADD CONSTRAINT Echange_receveur_Objet_idUser FOREIGN KEY (reveceurUser) REFERENCES Utilisateur(idUser);

INSERT INTO Utilisateur (nomUser, prenomUser, password, estAdmin)
VALUES
("John", "Doe", "123456", 1),
("Jane", "Doe", "abcdef", 0);

INSERT INTO Categorie (nomCategorie)
VALUES
("Electronics"),
("Fashion");

INSERT INTO Objet (description, nomObjet, categorie, prixEstimatif, photos, idUser)
VALUES 
("A brand new iPhone XR", "iPhone XR", 1, 999.99, "iPhoneXR.jpg", 1),
("A stylish black dress", "Black Dress", 2, 49.99, "BlackDress.jpg", 2),
("A shneider stylo", "Stylo", 2, 9.99, "Stylo.jpg", 2);

