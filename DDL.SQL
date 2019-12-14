/*DROP DATABASE IF EXISTS StudentServices;*/

CREATE DATABASE IF NOT EXISTS StudentServices;
USE StudentServices;


DROP TABLE IF EXISTS PERSOON;
DROP TABLE IF EXISTS FEEDBACK;
DROP TABLE IF EXISTS VRAAGAANBOD;
DROP TABLE IF EXISTS SELECTIECATEGORIE;
DROP TABLE IF EXISTS SELECTIEOPLEIDING;
DROP TABLE IF EXISTS BESCHIKBAARHEID;
DROP TABLE IF EXISTS PROFIEL;
DROP TABLE IF EXISTS SCHOOL;

CREATE TABLE PROFIEL (
ProfielID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Gebruikersnaam varchar(50) NOT NULL UNIQUE ,
Email varchar(50) NOT NULL,
Wachtwoord varchar(80) NOT NULL,
School varchar(45) NULL,
Opleiding varchar(23) NULL,
Startdatumopleiding date NULL,
Privelege INT NOT NULL DEFAULT 1,
Foto LONGBLOB DEFAULT NULL 
);

ALTER TABLE PROFIEL AUTO_INCREMENT = 1000;

CREATE TABLE PERSOON(
PersoonsID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Achternaam varchar(50) NOT NULL,
Voornaam varchar(50) NOT NULL,
Tussenvoegsel varchar(10) NOT NULL,
Prefix varchar(8) NULL,
Straat varchar(50) NOT NULL,
Huisnummer varchar(6) NOT NULL,
Extentie varchar(3) NULL,
Postcode varchar(6) NOT NULL,
Geboortedatum date NULL,
Telefoonnummer varchar(10) NULL,
FOREIGN KEY(PersoonsID) REFERENCES PROFIEL(ProfielID)  ON UPDATE CASCADE
);

CREATE TABLE SCHOOL
(
	SchoolID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Schoolnaam varchar(100) NOT NULL
);

CREATE TABLE SELECTIEOPLEIDING (
OpleidingID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Naamopleiding varchar(25) NOT NULL,
SchoolID int NOT NULL,
Locatie varchar(25) NOT NULL,
Voltijd_deeltijd int NOT NULL,
FOREIGN KEY(SchoolID) REFERENCES School(SchoolID)  ON UPDATE CASCADE
);

ALTER TABLE SELECTIEOPLEIDING MODIFY Naamopleiding varchar(100) NOT NULL ;
/*waarom voltijd_deeltijd int , dit is een enum. Oftwel een nummer. Zou zelfs een bool kunnen zijn.*/

ALTER TABLE  SELECTIEOPLEIDING AUTO_INCREMENT = 1000;

CREATE TABLE SELECTIECATEGORIE (
Categorienaam varchar(30) NOT NULL PRIMARY KEY
);

CREATE TABLE VRAAGAANBOD (
ProjectID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
ProfielID int NOT NULL,
Categorie varchar(30) NOT NULL,
Type varchar(15) NOT NULL,
Titel varchar(70) NOT NULL,
Inhoud varchar(300) NOT NULL,
Datumaangemaakt TIMESTAMP NOT NULL,
Deadline date NOT NULL,
Status varchar(20) NOT NULL,
Locatie varchar(25) REFERENCES SELECTIEOPLEIDING(Locatie),
School varchar(25) REFERENCES SELECTIEOPLEIDING(School),
FOREIGN KEY(ProfielID) REFERENCES Profiel(ProfielID)  ON UPDATE CASCADE,
FOREIGN KEY (Categorie) REFERENCES SELECTIECATEGORIE(Categorienaam)  ON UPDATE CASCADE
);

ALTER TABLE SELECTIECATEGORIE AUTO_INCREMENT = 1000;

CREATE TABLE REACTIE (
ProfielID INT,
Cijferterbeoordeling INT NULL,
Review varchar(500) DEFAULT NULL,
FOREIGN KEY(ProfielID) REFERENCES Profiel(ProfielID)  ON UPDATE CASCADE
);


CREATE TABLE BESCHIKBAARHEID (
ProjectID int NOT NULL,
ProfielID int NOT NULL,
Maandag time NOT NULL,
Dinsdag time NOT NULL,
Woensdag time NOT NULL,
Donderdag time NOT NULL,
Vrijdag time NOT NULL,
Zaterdag time NOT NULL,
Zondag time NOT NULL,
FOREIGN KEY(ProjectID) REFERENCES VRAAGAANBOD(ProjectID) ON UPDATE CASCADE,
FOREIGN KEY(ProfielID) REFERENCES PROFIEL(ProfielID) ON UPDATE CASCADE
);
