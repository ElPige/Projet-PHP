CREATE TABLE Voiture (
  reference integer,
  nom varchar(60),
  marque varchar(60),
  modele varchar(60),
  annee integer,
  img varchar(100),
  appartienRef integer;
  PRIMARY KEY(reference)
);

CREATE TABLE Membre (
  reference integer,
  nom varchar(60),
  prenom varchar(60),
  pseudo varchar(60),
  email varchar(100),
  telephone varchar(10);
  PRIMARY KEY(reference)
);
