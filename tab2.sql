CREATE TABLE eleves (
    eleve_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    date_naissance DATE,
    niveau_id INT
);

-- Création de la table des matières
CREATE TABLE matieres (
    matiere_id INT PRIMARY KEY AUTO_INCREMENT,
    nom_matiere VARCHAR(255)
);

-- Création de la table des niveaux d'études
CREATE TABLE niveaux (
    niveau_id INT PRIMARY KEY AUTO_INCREMENT,
    nom_niveau VARCHAR(255)
);
-- Création de la table des inscriptions
CREATE TABLE inscriptions (
    inscription_id INT PRIMARY KEY AUTO_INCREMENT,
    eleve_id INT(4),
    matiere_id INT(4),
    annee_scolaire YEAR
   
);

-- Création de la table des notes
CREATE TABLE notes (
    note_id INT PRIMARY KEY AUTO_INCREMENT,
    inscription_id INT(4),
    valeur_note DECIMAL(5, 2),
    date_note DATE,
    matiere_id INT(4),
    type_note VARCHAR(255)
  
);
Alter table eleves add constraint 
    foreign key(niveau_id) references niveaux(niveau_id);
Alter table notes add constraint 
    foreign key(inscription_id) references eleves(eleve_id);
Alter table notes add constraint 
    foreign key(matiere_id) references matieres(matiere_id);

 INSERT INTO inscriptions(eleve_id,matiere_id,annee_scolaire) VALUES
	(2,1,'2018'),
    (3,5,'2018'),
    (4,4,'2018'),
    (5,2,'2018'),

    (1,1,'2019'),
    (6,6,'2019'),
    (4,3,'2019'),
    (3,2,'2019'),


 INSERT INTO notes(inscription_id,valeur_note,date_note,matiere_id,type_note) VALUES
	(1,18.5,'2018-02-15',2,'CC'),
    (1,18.5,'2018-02-15',3,'CC'),
    (1,18.5,'2018-02-15',4,'CC'),
   (1,18.5,'2018-02-15',7,'CC'),

   (3,15,'2018-02-15',2,'CC'),
    (3,15,'2018-02-15',3,'CC'),
    (3,15,'2018-02-15',4,'CC'),
   (3,15,'2018-02-15',7,'CC'),

    (3,14,'2018-02-15',1,'CC'),
    (3,11,'2018-02-15',2,'CC'),
    (3,10,'2018-02-15',3,'CC'),
   (3,18,'2018-02-15',4,'CC'),

   (2,10,'2018-02-15',2,'EXAM'),
    (2,10,'2018-02-15',3,'EXAM'),
    (2,10,'2018-02-15',4,'EXAM'),
   (2,10,'2018-02-15',7,'EXAM'),
   

  
