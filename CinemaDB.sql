-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 20, 2026 alle 08:49
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CinemaDB`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `id_film` int(11) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `anno` int(11) DEFAULT NULL,
  `id_regista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Film`
--

INSERT INTO `Film` (`id_film`, `titolo`, `anno`, `id_regista`) VALUES
(1, 'Pulp Fiction', 1994, 2),
(2, 'Eraserhead', 1977, 1),
(3, 'Lost in translation', 2003, 4),
(4, 'Once upon a time in Hollywood', 2019, 2),
(5, 'Eyes Wide Shut', 1999, 6),
(6, 'The Shining', 1980, 6),
(7, 'Perfect Days', 2023, 7),
(8, 'My Neighbor Totoro', 1988, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `Registi`
--

CREATE TABLE `Registi` (
  `id_regista` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `nazionalita` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Registi`
--

INSERT INTO `Registi` (`id_regista`, `nome`, `cognome`, `nazionalita`) VALUES
(1, 'David', 'Lynch', 'USA'),
(2, 'Quentin', 'Tarantino', 'USA'),
(3, 'Martin', 'Scorsese', 'USA'),
(4, 'Sofia', 'Coppola', 'USA'),
(5, 'Hayao', 'Miyazaki', 'Giappone'),
(6, 'Stanley', 'Kubrick', 'USA'),
(7, 'Wim', 'Wenders', 'Germania'),
(8, 'Chan-wook', 'Park', 'Corea del sud');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `id_regista` (`id_regista`);

--
-- Indici per le tabelle `Registi`
--
ALTER TABLE `Registi`
  ADD PRIMARY KEY (`id_regista`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Film`
--
ALTER TABLE `Film`
  ADD CONSTRAINT `Film_ibfk_1` FOREIGN KEY (`id_regista`) REFERENCES `Registi` (`id_regista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
