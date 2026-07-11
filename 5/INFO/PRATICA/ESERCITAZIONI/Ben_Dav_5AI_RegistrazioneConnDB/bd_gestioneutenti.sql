-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2026 alle 08:36
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_gestioneutenti`
--
CREATE DATABASE IF NOT EXISTS `bd_gestioneutenti` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_gestioneutenti`;

-- --------------------------------------------------------

--
-- Struttura della tabella `accessi`
--

DROP TABLE IF EXISTS `accessi`;
CREATE TABLE IF NOT EXISTS `accessi` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `dataInizio` date NOT NULL,
  `oraInizio` time NOT NULL,
  `dataFine` date DEFAULT NULL,
  `oraFine` time DEFAULT NULL,
  `utente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idA`),
  KEY `utente` (`utente`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `accessi`
--

INSERT INTO `accessi` (`idA`, `dataInizio`, `oraInizio`, `dataFine`, `oraFine`, `utente`) VALUES
(13, '2026-04-23', '11:12:31', '2026-04-23', '11:13:02', 2),
(16, '2026-04-27', '12:13:41', '2026-04-27', '12:15:04', 2),
(18, '2026-05-07', '11:14:18', '2026-05-07', '11:24:59', 2),
(19, '2026-05-07', '11:25:18', '2026-05-07', '11:25:21', 2),
(20, '2026-05-07', '11:25:26', '2026-05-07', '11:26:21', 2),
(21, '2026-05-06', '11:26:26', '2026-05-07', '12:26:45', 2),
(22, '2026-05-07', '11:26:55', '2026-05-07', '11:36:58', 2),
(24, '2026-05-13', '21:58:59', '2026-05-13', '21:59:11', 5),
(25, '2026-05-13', '21:59:22', '2026-05-13', '21:59:29', 5),
(26, '2026-05-13', '22:03:00', '2026-05-13', '23:03:21', 2),
(27, '2026-05-13', '23:03:32', '2026-05-13', '23:03:36', 2),
(28, '2026-05-13', '23:03:44', '2026-05-13', '23:05:24', 5),
(29, '2026-05-13', '23:05:49', '2026-05-13', '23:05:53', 5),
(30, '2026-05-13', '23:05:58', '2026-05-13', '23:06:08', 2),
(31, '2026-05-13', '23:06:17', '2026-05-13', '23:08:26', 5),
(32, '2026-05-13', '23:14:36', '2026-05-13', '23:14:44', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipoutente`
--

DROP TABLE IF EXISTS `tipoutente`;
CREATE TABLE IF NOT EXISTS `tipoutente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `descrizione` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `tipoutente`
--

INSERT INTO `tipoutente` (`id`, `tipo`, `descrizione`) VALUES
(1, 'admin', 'colui che detiene il potere'),
(2, 'client', 'cliente che rompe le scatole');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `dataNascita` date NOT NULL,
  `sesso` char(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL CHECK (char_length(`password`) >= 8),
  `telefono` varchar(10) NOT NULL,
  `residenza` varchar(20) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idU`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telefono` (`telefono`),
  KEY `ruolo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`idU`, `nome`, `cognome`, `dataNascita`, `sesso`, `email`, `password`, `telefono`, `residenza`, `tipo`) VALUES
(2, 'Giulia', 'Bianchi', '2000-09-22', 'F', 'giulia.bianchi@email.it', 'password2', '3332222222', 'Brescia', 1),
(5, 'Paolo', 'Gialli', '2001-12-05', 'M', 'paolo.gialli@email.it', 'password5', '3335555556', 'Mantova', 2);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accessi`
--
ALTER TABLE `accessi`
  ADD CONSTRAINT `accessi_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`idU`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipoutente` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
