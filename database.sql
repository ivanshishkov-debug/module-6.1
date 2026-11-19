-- Database voor 'Ontmoet de Oudegracht'
-- Importeren: phpMyAdmin > Importeren > dit bestand kiezen
CREATE DATABASE IF NOT EXISTS oudegracht CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE oudegracht;

CREATE TABLE IF NOT EXISTS gebruikers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  naam VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  wachtwoord VARCHAR(255) NOT NULL,
  aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS geluiden (
  id INT AUTO_INCREMENT PRIMARY KEY,
  naam VARCHAR(100) NOT NULL,
  bestandspad VARCHAR(255) NOT NULL,
  alt_beschrijving VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS punten (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titel_key VARCHAR(100) NOT NULL,
  tekst_key VARCHAR(100) NOT NULL,
  tijd_in_film DECIMAL(7,2) NOT NULL DEFAULT 0,
  positie_x TINYINT UNSIGNED NOT NULL DEFAULT 50,
  positie_y TINYINT UNSIGNED NOT NULL DEFAULT 50,
  geluid_id INT NULL,
  actief TINYINT(1) NOT NULL DEFAULT 1,
  FOREIGN KEY (geluid_id) REFERENCES geluiden(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS teksten (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sleutel VARCHAR(100) NOT NULL,
  taal CHAR(2) NOT NULL DEFAULT 'nl',
  inhoud TEXT NOT NULL,
  UNIQUE KEY sleutel_taal (sleutel, taal)
);

CREATE TABLE IF NOT EXISTS instellingen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sleutel VARCHAR(100) NOT NULL UNIQUE,
  waarde VARCHAR(255) NOT NULL
);

-- Voorbeelddata (pas aan zodra het bronmateriaal er is)
INSERT INTO instellingen (sleutel, waarde) VALUES
('video_bestand', 'assets/video/oudegracht.mp4');

INSERT INTO teksten (sleutel, taal, inhoud) VALUES
('start_titel', 'nl', 'Ontmoet de Oudegracht'),
('start_uitleg', 'nl', 'Bekijk oude filmbeelden van de Oudegracht. Veeg over de film of gebruik de pijlen om langs de plekken te varen. Raak een stip op de kaart aan om direct naar een plek te gaan.'),
('start_knop', 'nl', 'Start'),
('colofon_knop', 'nl', 'Over deze applicatie'),
('colofon_titel', 'nl', 'Over deze applicatie'),
('colofon_tekst', 'nl', 'Deze applicatie is gemaakt voor de tentoonstelling Ontmoet de Oudegracht van Het Utrechts Archief, ter ere van het 900-jarig bestaan van de Oudegracht. Gemaakt door studenten web development.'),
('punt1_titel', 'nl', 'Begin van de Oudegracht'),
('punt1_tekst', 'nl', 'Hier begint de reis langs de werven.'),
('punt2_titel', 'nl', 'De werven'),
('punt2_tekst', 'nl', 'Op de werven werd gelost en geladen.'),
('punt3_titel', 'nl', 'Een brug'),
('punt3_tekst', 'nl', 'Bruggen verbinden de twee kanten van de stad.');

INSERT INTO punten (titel_key, tekst_key, tijd_in_film, positie_x, positie_y) VALUES
('punt1_titel', 'punt1_tekst', 0, 12, 70),
('punt2_titel', 'punt2_tekst', 20, 50, 40),
('punt3_titel', 'punt3_tekst', 40, 85, 25);
