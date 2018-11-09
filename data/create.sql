DROP TABLE Voiture;
DROP TABLE Membre;

CREATE TABLE Voiture (
  reference integer,
  nom varchar(60),
  marque varchar(60),
  modele varchar(60),
  annee integer,
  img varchar(100),
  appartienRef integer,
  prix integer,
  PRIMARY KEY(reference)
);

CREATE TABLE Membre (
  reference integer,
  nom varchar(60),
  prenom varchar(60),
  pseudo varchar(60),
  mdp varchar(10),
  email varchar(100),
  telephone varchar(10),
  PRIMARY KEY(reference)
);

CREATE TABLE Annonce (
  reference integer,
  titre varchar(50),
  descriptif varchar(1000),
  PRIMARY KEY(reference)
);
