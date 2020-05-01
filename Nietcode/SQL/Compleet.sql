CREATE DATABASE IF NOT EXISTS StudentServices;
USE StudentServices;

DROP TABLE IF EXISTS FEEDBACK;
DROP TABLE IF EXISTS REACTIE;
DROP TABLE IF EXISTS BESCHIKBAARHEID;
DROP TABLE IF EXISTS PROJECT;
DROP TABLE IF EXISTS GEBRUIKER;
DROP TABLE IF EXISTS SELECTIECATEGORIE;
DROP TABLE IF EXISTS SELECTIEOPLEIDING;
DROP TABLE IF EXISTS SCHOOL;

CREATE TABLE SCHOOL(
	SchoolID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Locatie varchar(40) NOT NULL,
	Postcode varchar(8) NOT NULL,
	Schoolnaam varchar(100) NOT NULL
);

ALTER TABLE SCHOOL AUTO_INCREMENT = 1000;

CREATE TABLE SELECTIEOPLEIDING (
OpleidingID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Naamopleiding varchar(100) NOT NULL,
Voltijd_deeltijd ENUM('Voltijd', 'Duaal', 'Deeltijd') NOT NULL
);

ALTER TABLE SELECTIEOPLEIDING MODIFY Naamopleiding varchar(100) NOT NULL;

ALTER TABLE  SELECTIEOPLEIDING AUTO_INCREMENT = 1000;

CREATE TABLE SELECTIECATEGORIE (
CategorieID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Categorienaam varchar(30) NOT NULL
);

CREATE TABLE GEBRUIKER(
GebruikerID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Gebruikersnaam varchar(50) NOT NULL UNIQUE,
Wachtwoord varchar(90) NOT NULL,
Email varchar(50) NOT NULL,
School int NULL ,
Opleiding int NULL,
Startdatumopleiding date NULL,
Foto BLOB DEFAULT NULL,
Status ENUM('actief', 'non actief', 'verwijderd') DEFAULT 'actief',
Achternaam varchar(60) NOT NULL,
Voornaam varchar(50) NOT NULL,
Tussenvoegsel varchar(10) NULL,
Prefix varchar(8) NULL,
Straat varchar(50) NOT NULL,
Huisnummer int NOT NULL,
Extentie varchar(3) NULL,
Postcode varchar(6) NOT NULL,
Woonplaats varchar(60) NOT NULL,
Geboortedatum date NULL, 
Telefoonnummer varchar(15) NULL,
FOREIGN KEY(School) REFERENCES School(SchoolID) ON UPDATE CASCADE,
FOREIGN KEY(Opleiding) REFERENCES SELECTIEOPLEIDING(OpleidingID) ON UPDATE CASCADE   
);

ALTER TABLE GEBRUIKER CHANGE Tussenvoegsel Tussenvoegsel varchar(10) NULL;
ALTER TABLE GEBRUIKER AUTO_INCREMENT = 1000;

CREATE TABLE PROJECT (
ProjectID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
GebruikerID int NOT NULL,
Type1 varchar(15) NOT NULL,
Titel varchar(70) NOT NULL,
Beschrijving varchar(500) NOT NULL,
CategorieID int NOT NULL,
Datumaangemaakt TIMESTAMP NOT NULL,
Deadline datetime NULL,
Status BOOLEAN DEFAULT TRUE,
Locatie varchar(40) REFERENCES SCHOOL(Locatie),
Verwijderd BOOLEAN NOT NULL DEFAULT 0,
FOREIGN KEY(CategorieID) REFERENCES SELECTIECATEGORIE(CategorieID) ON UPDATE CASCADE,
FOREIGN KEY(GebruikerID) REFERENCES GEBRUIKER(GebruikerID) ON UPDATE CASCADE
);

ALTER TABLE project Change Type1 Type varchar(15) NOT NULL;
ALTER TABLE project Change Type Type ENUM('Vragen','Aanbieden','Onbekend') DEFAULT 'Onbekend';

CREATE TABLE REACTIE (
ReactieID INT PRIMARY KEY AUTO_INCREMENT,
GebruikerID INT,
ProjectID INT,
Reactie varchar(500) DEFAULT NULL,
FOREIGN KEY(GebruikerID) REFERENCES GEBRUIKER(GebruikerID) ON UPDATE CASCADE,
FOREIGN KEY(ProjectID) REFERENCES PROJECT(ProjectID) ON UPDATE CASCADE
);

CREATE TABLE BESCHIKBAARHEID (
ProjectID int NOT NULL,
GebruikerID int NOT NULL,
Dagbeschikbaar DATE NOT NULL,
starttijd TIME NOT NULL,
Eindtijd TIME NOT NULL,
FOREIGN KEY(ProjectID) REFERENCES PROJECT(ProjectID) ON UPDATE CASCADE,
FOREIGN KEY(GebruikerID) REFERENCES GEBRUIKER(GebruikerID) ON UPDATE CASCADE,
PRIMARY KEY (ProjectID, GebruikerID, Dagbeschikbaar,starttijd,Eindtijd)
);

CREATE TABLE FEEDBACK(
FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
GebruikerID INT NOT NULL,
ProjectID INT NOT NULL,
Cijfer INT NOT NULL,
Review varchar(500) NOT NULL,
FOREIGN KEY(ProjectID) REFERENCES PROJECT(ProjectID) ON UPDATE CASCADE,
FOREIGN KEY(GebruikerID) REFERENCES GEBRUIKER(GebruikerID) ON UPDATE CASCADE
);




INSERT INTO SCHOOL (schoolnaam) values('Avans Hogeschool'),
('Aeres Hogeschool'),
('Amsterdamse Hogeschool voor de Kunsten'),
('ArtEZ Hogeschool voor de Kunsten'),
('Breda University of Applied Sciences'),
('Christelijke Hogeschool Ede'),
('Codarts Rotterdam'),
('De Haagse Hogeschool'),
('Design Academy Eindhoven'),
('Driestar hogeschool'),
('Fontys Hogescholen'),
('Gerrit Rietveld Academie'),
('Hanzehogeschool Groningen'),
('HAS Hogeschool'),
('Hogeschool de Kempel'),
('Hogeschool der Kunsten Den Haag'),
('Hogeschool Inholland'),
('Hogeschool iPabo'),
('Hogeschool Leiden'),
('Hogeschool Rotterdam'),
('Hogeschool Utrecht'),
('Hogeschool van Amsterdam'),
('Hogeschool van Arnhem en Nijmegen'),
('Hogeschool Viaa'),
('Hogeschool voor de Kunsten Utrecht'),
('Hotelschool The Hague'),
('HZ University of Applied Sciences'),
('Iselinge Hogeschool'),
('Katholieke Pabo Zwolle'),
('Marnix Academie'),
('NHL Stenden Hogeschool'),
('Saxion'),
('Thomas More Hogeschool'),
('Van Hall Larenstein University of Applied Sciences'),
('Windesheim'),
('Zuyd Hogeschool');

Insert into selectieopleiding (Naamopleiding,Voltijd_deeltijd) 
values('Accountancy','Voltijd'),
('Accountancy','Voltijd'),
('Accountancy','Duaal'),
('Accountancy Associate degree','Deeltijd'),
('Bedrijfskunde','Deeltijd'),
('Bedrijfskunde','Voltijd'),
('Bedrijfskunde Associate degree','Deeltijd'),
('Business IT & Management','Deeltijd'),
('Business IT & Management','Voltijd'),
('Commerciële Economie','Deeltijd'),
('Commerciële Economie','Voltijd'),
('Communicatie','Deeltijd'),
('Communicatie','Voltijd'),
('Communicatie Associate degree','Deeltijd'),
('Finance & Control','Deeltijd'),
('Finance & Control','Voltijd'),
('Finance & Control (international)','Voltijd'),
('Human Resource Management','Deeltijd'),
('Human Resource Management','Voltijd'),
('Human Resource Management Associate degree','Deeltijd'),
('Industrial Engineering & Management','Voltijd'),
('Informatica','Deeltijd'),
('Informatica','Voltijd'),
('Integrale Veiligheidskunde','Voltijd'),
('International Business','Voltijd'),
('Management in de Zorg','Deeltijd'),
('Management in de Zorg Associate degree','Deeltijd'),
('Marketing Management Associate degree','Deeltijd'),
('Ondernemerschap & Retail Management','Deeltijd'),
('Ondernemerschap & Retail Management','Voltijd'),
('Ondernemerschap & Retail Management Associate degree','Deeltijd'),
('Accountancy','Voltijd'),
('Aeronautical Engineering (EN)','Voltijd'),
('Associate degree Business Studies Logistiek','Voltijd'), 
('Associate degree Crossmediale Communicatie','Voltijd'), 
('Associate degree Facilitair Eventmanagement','Voltijd'),
('Associate degree Finance & Control (Ad Bedrijfseconomie)','Voltijd'),
('Associate degree IT Service Management','Voltijd'), 
('Associate degree IT Service Management','Deeltijd'),
('Associate degree Pedagogisch Educatief Professional','Deeltijd'),
('Associate degree Sociaal Financiële Dienstverlening','Deeltijd'),
('Associate degree Tuinbouwmanagement','Voltijd'),
('Biologie en Medisch Laboratoriumonderzoek','Voltijd'),
('Biotechnologie','Voltijd'), 
('Bouwkunde','Voltijd'), 
('Bouwmanagement & Vastgoed / Ruimtelijke Ontwikkeling','Voltijd'), 
('Business Innovation (EN)','Voltijd'), 
('Business IT & Management','Voltijd'), 
('Business IT & Management','Deeltijd'), 
('Business Studies','Voltijd'), 
('Chemie','Voltijd'), 
('Civiele Techniek','Voltijd'), 
('Communicatie','Voltijd'), 
('Creative Business','Voltijd'), 
('Creative Business (EN)','Voltijd'), 
('Dier- en Veehouderij','Voltijd'), 
('Elektrotechniek','Voltijd'), 
('Elektrotechniek','Deeltijd'), 
('Facility Management','Voltijd'),
('Finance & Control: Bedrijfseconomie','Voltijd'), 
('Food Commerce and Technology','Voltijd'), 
('HBO - Rechten','Voltijd'), 
('HBO - Rechten','Deeltijd'), 
('Informatica','Voltijd'), 
('Information Technology (EN)','Voltijd'),
('Integrale Veiligheidskunde','Voltijd'), 
('Integrale Veiligheidskunde','Deeltijd'), 
('Landscape and Environment Management','Voltijd'), 
('Leisure & Events Management','Voltijd'), 
('Leraar Basisonderwijs (Pabo)','Voltijd'), 
('Leraar Basisonderwijs (Pabo)','Duaal'), 
('Leraar Basisonderwijs (Pabo)','Deeltijd'), 
('Leraar Basisonderwijs Digitaal (DigiPabo)','Deeltijd'), 
('Luchtvaarttechnologie','Voltijd'), 
('Master Advanced Health Informatics Practice','Deeltijd'), 
('Master Educational Leadership','Deeltijd'), 
('Master Leren en Innoveren','Deeltijd'), 
('Master Medical Imaging / Radiation Oncology','Deeltijd'), 
('Master of Advanced Nursing Practice','Duaal'), 
('Master Pedagogiek','Deeltijd'), 
('Master Physician Assistant','Duaal'), 
('Mathematical Engineering (EN)','Voltijd'), 
('Medisch Beeldvormende en Radiotherapeutische Technieken','Voltijd'), 
('Medisch Beeldvormende en Radiotherapeutische Technieken','Duaal'), 
('Mondzorgkunde','Voltijd'),
('Muziek','Voltijd'), 
('Pedagogiek','Voltijd'), 
('Precision Engineering (afstudeerrichting Luchtvaarttechnologie)','Voltijd'), 
('Sociaal Juridische Dienstverlening','Voltijd'), 
('Sociaal Juridische Dienstverlening','Deeltijd'), 
('Social Work','Voltijd'), 
('Social Work','Deeltijd'), 
('Sportkunde','Voltijd'), 
('Technische Bedrijfskunde','Voltijd'), 
('Technische Bedrijfskunde','Deeltijd'), 
('Technische Informatica','Voltijd'), 
('Tourism Management','Voltijd'), 
('Tourism Management (EN)','Voltijd'), 
('Tuinbouw & Agribusiness','Voltijd'), 
('Tuinbouw & Agribusiness','Deeltijd'), 
('Verloskunde','Voltijd'), 
('Verpleegkunde','Voltijd'), 
('Verpleegkunde','Duaal'), 
('Verpleegkunde','Deeltijd'), 
('Werktuigbouwkunde','Voltijd'), 
('Werktuigbouwkunde','Deeltijd');

Insert into selectieCategorie (Categorienaam) Values
('Kleien'),
('Fotograferen'),
('Rapporteren'),
('Leren'),
('Tekenen'),
('Rekenen'),
('Taal'),
('Bijles'),
('Proftaak'),
('Typen'),
('Luisteren'),
('Samenwerken'),
('Oversteken'),
('Netheid'),
('Taalvaardigheid'),
('Networking'),
('Hardware'),
('Sofware'),
('Verslagen'),
('Eten en drinken');

Delete from gebruiker;
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats) 
VALUES ('Patrick','Ruijter','de','Patrick','phwm.deruijter@student.avans.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),
'2019-08-31', 'Hoge donk',1, '1234RD', 'Breda');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
Values ('Serkan','Tumkaya',null,'rh@gmail.com','s.tumkaya@avans.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Oosterhoutseweg',1212, '4940QW', 'Oosterhout', '1997-07-12');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Dirk','Vliet','van der','Dirk','d.vandervliet1@student.avans.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Hertogshoef',234, '4951ZZ', 'Raamsdonksveer', '1980-12-22');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Joost','Sadeleer','de','Joost','jfjm.desadeleer@student.avans.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Rivierdijk',12, '3372RD', 'Hardinxveld-Giessendam', '1976-01-24');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Jelle','Ruiter','de','Jelle','jj.deruiter2@student.avans.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Brabanderlaan',100, '4534RD', 'Breda', '1988-10-30');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Pieter','Smets',null,'psmets@gmail.com','psmets@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Ing.Metz hof', 67,'1344IJ', 'Raamsdonksveer', '1999-05-01');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Marriane','Jylha',null,'M.Jylha@gmail.com','M.Jylha@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Olijflaan',123, '2222PL', 'Oosterhout', '1966-11-06');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Nico','Jong','de','NicodeJong@gmail.com','NicoDeJong@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Overweg',12, '1234IJ', 'Rijen', '2001-02-17');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Donny','Muller',null,'dmuller@gmail.com','dmuller@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Duitsstraat',66, '1333DD', 'Oosterhout', '1972-09-13');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Mik','Beer','de','MikdeBeer@gmail.com','MikdeBeer@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Dirk-Jan laan',1233, '2234RD', 'Breda','1989-03-15');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Miguel','Venancio',null,'MiguelVenancio@gmail.com','MiguelVenancio@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Brede weg',12, '2212', 'Breda','1971-04-24');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Linda','Heijst','van','LindaVanHeijst@gmail.com','LindaVanHeijst@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Adolf Rolfstraat',33, '4233DE', 'Lage-Zwaluwe','1995-03-02');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Randy','FCooijman','','Cooijman@gmail.com','Cooijman@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1) ,(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-31', 'Jullaan',23, '2343RD', 'Oosterhout', '1997-08-28');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Peter','Mosselaar','van den','Peter@gmail.com','peter@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1),
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),
'2019-08-31', 'Jullaan',23, '2343RD', 'Oosterhout','1997-04-11');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Johan','grave','van den','mezelf123','johan.vd.grave@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Avans Hogeschool' LIMIT 1),
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),
'2019-08-31', 'Jullaan',23, '2343RD', 'Oosterhout','1997-04-11');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Bart','Boer','de','BartDeBoer@gmail.com','BartDeBoer@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Creative Business' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-24', 
'Julia Dildorlaan',13, '3344UJ', 'Rotterdam','1997-08-28');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Dirk','Jumbo','van de','dirkvandejumbo@gmail.com','dirkvandejumbo@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Biotechnologie' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-24', 
'Feyenoord',17, '3345FY', 'Rotterdam','1998-03-09');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Lucas','Harten','den','ldh@ziggo.nl','ldh@ziggo.nl','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Informatica' and Voltijd_deeltijd = 'Voltijd' LIMIT 1),'2019-08-24', 
'Admiraal de Ruyterlaan',800, '3345FB', 'Rotterdam','1997-09-09');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Teunis','Ruijter','de','teunis@gmail.com','teunis@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Tuinbouw & Agribusiness' and Voltijd_deeltijd = 'Deeltijd' LIMIT 1),'2019-09-01', 
'Den hoge laan',10, '3345FB', 'Ridderkerk','1997-12-23');
INSERT INTO gebruiker(Voornaam, Achternaam, Tussenvoegsel,Gebruikersnaam, Email, Wachtwoord, School, Opleiding, Startdatumopleiding, Straat,Huisnummer,Postcode,Woonplaats,Geboortedatum) 
VALUES ('Diana','Alashraf','','dalashraf@gmail.com','dalashraf@gmail.com','ada8c87c942a3685dea10eccbc9f9011adf03d5341aaa467f64a6c182340e413',
(Select schoolid from school where schoolnaam = 'Hogeschool Rotterdam' LIMIT 1) ,
(SELECT OpleidingID FROM selectieopleiding WHERE Naamopleiding = 'Creative Business' and Voltijd_deeltijd = 'Deeltijd' LIMIT 1),'2019-09-01', 
'Drijversschuit',12, '3372GH', 'Boven-Hardinxveld','1997-11-19');

INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='ruudderooi@gmail.com' Limit 1), '1', 'Hulp nodig bij fotografie', 
'Ik heb een specialistisch kennis nodig voor het maken van foto''s van mijn project', 
(Select CategorieID from selectiecategorie where Categorienaam ='Fotograferen' Limit 1)
, '2019-12-19', '2020-06-24', 0, 
'Bij mij thuis in Breda', 'false') ;

INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='MariskaRaamsdonk@gmail.com' Limit 1), '1', 'Rapporteren lessen gemist', 
'Ik heb de lessen van Marnix Holleman gemist en nu kan ik niet rapporteren wie kan mij helpen', 
(Select CategorieID from selectiecategorie where Categorienaam ='Rapporteren' Limit 1)
, '2019-12-19', '2020-02-12', 0, 
'Op school lovensedijk?', 'false') ;

INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='LindaVanHeijst@gmail.com' Limit 1), '2', 'Bied hulp aan bij Kleien', 
'Bij deze biedt ik mijn hulp aan bij kleien. Als bijna afgestudeerdekunstenaar kan ik heel goed kleien', 
(Select CategorieID from selectiecategorie where Categorienaam ='Kleien' Limit 1)
, '2019-12-19', '2020-06-24', 1, 
'Waar jij de hulp wil hebben. Wel in de buurt van Breda want ik kom op de fiets.', 'false'); 


INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1), '2', 'Hulp aangeboden bij Sofware schrijven.', 
'Ik ben super goed al zeg ik het zelf. En daarom help ik graag met programmeren.', 
(Select CategorieID from selectiecategorie where Categorienaam ='Sofware' Limit 1)
, '2019-12-19', '2020-06-24', 1, 
'Waar jij wil.', 'false') ;

INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='NicoDeJong@gmail.com' Limit 1), '1', 'Brabants afleren.', 
'Ik heb problemen met spreken. Ik probeer van mijn accent af te komen. Wil wil luisteren of ik er van af ben.', 
(Select CategorieID from selectiecategorie where Categorienaam ='Luisteren' Limit 1)
, '2019-12-19', '2020-06-24', 0, 
'Het hart van Breda', 'false'); 

INSERT INTO project 
(GebruikerID, Type, Titel, Beschrijving, CategorieID, Datumaangemaakt, Deadline, Status, Locatie, Verwijderd)
values ((Select GebruikerID from Gebruiker where Gebruikersnaam ='MikdeBeer@gmail.com' Limit 1), '2', 'Wie kan mij helpen met designpatterns', 
'Ik snap het principe van designpatterns alleen heb ik nog moeite met C# wie kan mij helpen?', 
(Select CategorieID from selectiecategorie where Categorienaam ='Sofware' Limit 1)
, '2019-12-19', '2020-06-24', 1, 
'Waar jij wil.', 'false') ;

INSERT INTO reactie (GebruikerID,ProjectID,Reactie) Values(
(Select GebruikerID from Gebruiker where Gebruikersnaam ='MariskaRaamsdonk@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Brabants afleren.' Limit 1),
'Hallo ik ben een logopodist in opleiding. Ik wil je wel helpen.!');

INSERT INTO reactie (GebruikerID,ProjectID,Reactie) Values(
(Select GebruikerID from Gebruiker where Gebruikersnaam ='JoostvanIperen@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Rapporteren lessen gemist' Limit 1),
'Ik wil je wel helpen. Wat en waar?');

INSERT INTO reactie (GebruikerID,ProjectID,Reactie) Values(
(Select GebruikerID from Gebruiker where Gebruikersnaam ='rh@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Rapporteren lessen gemist' Limit 1),
'Ik kan het je wel navertellen hoor geen probleem.?');

INSERT INTO reactie (GebruikerID,ProjectID,Reactie) Values(
(Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Wie kan mij helpen met designpatterns.' Limit 1),
'Ik ben de beste in C# in mijn bescheidenheid. Ik wil je wel helpen. Schut ik zo uit mijn mouw.');

INSERT INTO BESCHIKBAARHEID (
ProjectID ,GebruikerID,Dagbeschikbaar,starttijd,Eindtijd)
VALUES ((Select ProjectID from project where Titel = 'Hulp aangeboden bij Sofware schrijven.' Limit 1),
(Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1),
'2020-01-02','19:00','22:00');

INSERT INTO BESCHIKBAARHEID (
ProjectID ,GebruikerID,Dagbeschikbaar,starttijd,Eindtijd)
VALUES ((Select ProjectID from project where Titel = 'Hulp aangeboden bij Sofware schrijven.' Limit 1),
(Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1),
"2020-01-09","19:00","22:00");

INSERT INTO BESCHIKBAARHEID (
ProjectID ,GebruikerID,Dagbeschikbaar,starttijd,Eindtijd)
VALUES ((Select ProjectID from project where Titel = 'Hulp aangeboden bij Sofware schrijven.' Limit 1),
(Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1),
"2020-01-16","19:00","22:00");

INSERT INTO FEEDBACK(GebruikerID ,ProjectID ,Cijfer ,Review)
Values (
(Select GebruikerID from Gebruiker where Gebruikersnaam ='MikdeBeer@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Wie kan mij helpen met designpatterns' Limit 1),5, 
'Peter van den Mosselaar weet idd wel wat van C# af alleen niet zo goed als hij zelf zegt. Ik heb uiteindelijk alles zelf gedaan.');

INSERT INTO FEEDBACK(GebruikerID ,ProjectID ,Cijfer ,Review)
Values (
(Select GebruikerID from Gebruiker where Gebruikersnaam ='Peter@gmail.com' Limit 1),
(Select ProjectID from project where Titel = 'Wie kan mij helpen met designpatterns' Limit 1),
10, 'Zo als gewoonlijk heb ik het weer zo weten op te lossen. Mik was tevreden,');

CREATE VIEW `Leeftijden` as SELECT SUM(IF(Leeftijd < 20,1,0)) as 'Onder 20',
SUM(IF(Leeftijd BETWEEN 20 and 29,1,0)) as '20-29',
SUM(IF(Leeftijd BETWEEN 30 and 39,1,0)) as '30-39',
SUM(IF(Leeftijd BETWEEN 40 and 49,1,0)) as '40-49',
SUM(IF(Leeftijd >50,1,0)) as 'Ouder dan 50',
SUM(IF(Leeftijd IS NULL,1,0)) as 'Niet bekend'
FROM (select (TIMESTAMPDIFF(YEAR, Geboortedatum, CURDATE())) as Leeftijd FROM gebruiker) AS derived;

CREATE VIEW `Projecten_leeftijdcategorie` as
SELECT SUM(IF(Leeftijd <20,1,0)) as 'onder 20', 
SUM(IF(Leeftijd BETWEEN 20 AND 29 ,1,0)) as '20-29', 
SUM(IF(Leeftijd BETWEEN 30 AND 39,1,0)) as '30-39', 
SUM(IF(Leeftijd BETWEEN 40 AND 49,1,0)) as '40-49', 
SUM(IF(Leeftijd >50,1,0)) as 'Ouder dan 50', 
SUM(IF(Leeftijd IS NULL,1,0)) as 'Niet Bekend'  
FROM (SELECT project.projectID, project.GebruikerID, (SELECT (TIMESTAMPDIFF(YEAR,gebruiker.Geboortedatum,CURDATE()))) AS Leeftijd FROM project LEFT JOIN gebruiker ON project.GebruikerID = gebruiker.GebruikerID) AS derived;

CREATE USER 'SSimp'@'localhost' IDENTIFIED BY 'SSimp1234!';
GRANT ALL PRIVILEGES ON *.* TO 'SSimp'@'localhost';