drop database if exists eschool;
create database if not exists eschool;
use eschool;

create table enseignant(
    idProf int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    genre varchar(1),
	numeroP varchar(25),
	identifiantP varchar(250),
	pwd varchar(255),
	email varchar(50),
	role varchar(50),
	etat varchar(1),
    idMatiere int(4)
);

create table matiere(
    idMatiere int(4) auto_increment primary key,
    nomMatiere varchar(50),
    niveau varchar(50)
);

create table eleve(
    ide int(4) auto_increment primary key,
    nom varchar(50),
	prenom varchar(50),
	genre varchar(1),
	birthday varchar(50),
    number varchar(255),
	identifiantE varchar(50),
	email varchar(50),
    pwd varchar(255),   
    etat int(1),        
);
create table notes_tleA(
    ide int(4) auto_increment primary key,
    notes1 varchar(50),
	prenom varchar(50),
	genre varchar(1),
	birthday varchar(50),
    number varchar(255),
	identifiantE varchar(50),
	email varchar(50),
    pwd varchar(255),   
    etat int(1),        
);
Alter table enseignant add constraint 
    foreign key(idMatiere) references matiere(idMatiere);

INSERT INTO matiere(nomMatiere,niveau) VALUES
	('Francais','TleA'),
	('Philosophie','TleD'),
	('Maths','3eme'),
	('Physique-Chimie','5eme'),
	('SVT','1ereD'),
    ('Anglais','4eme'),
	('Francais','TleA'),
	('Philosophie','TleD'),
	('Maths','3eme'),
	('Physique-Chimie','5eme'),
	('SVT','1ereD'),
    ('Anglais','4eme'),
	('Francais','TleA'),
	('Philosophie','TleD'),
	('Maths','3eme'),
	('Physique-Chimie','5eme'),
	('SVT','1ereD'),
    ('Anglais','4eme'),
	('Francais','TleA'),
	('Philosophie','TleD'),
	('Maths','3eme'),
	('Physique-Chimie','5eme'),
	('SVT','1ereD'),
    ('Anglais','4eme');	
	
	
INSERT INTO eleve(nom,prenom,genre,birthday,number,identifiantE,email,pwd,etat) VALUES 
    ('Solo','Traore','M','25-05-2002','0619944598','ET21006','admin@gmail.com',md5('123'),0),
    ('Awa','Traore','M','22-07-2002','0619944598','ET21007','admin@gmail.com',md5('123'),0),
	('Omar','Traore','M','15-09-2002','0619944598','ET21008','admin@gmail.com',md5('123'),0),	

INSERT INTO enseignant(nom,prenom,genre,numeroP,identifiantP,pwd,email,role,etat,idMatiere) VALUES
    ('BOKO','David','M','05541254','P2024PH',md5('123'),'admin@gmail.com','ADMININ',1,2),
	('Traore','solo','M','05541254','P2024PH',md5('123'),'admin@gmail.com','ADMININ',1,3),
	('DAO','DRISSA','M','05541254','P2024PH',md5('123'),'admin@gmail.com','ADMININ',1,4),
	('BISSOUMA','Ilyass','M','05541254','P2024PH',md5('123'),'admin@gmail.com','ADMININ',1,5);
  

select * from matiere;
select * from enseignant;
select * from eleve;


