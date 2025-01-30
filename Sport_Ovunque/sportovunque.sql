-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 05:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportovunque`
--

-- --------------------------------------------------------

--
-- Table structure for table `abbonati`
--

CREATE TABLE `abbonati` (
  `id_abbonato` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `data_registrazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `abbonati`
--

INSERT INTO `abbonati` (`id_abbonato`, `nome`, `cognome`, `email`, `password_hash`, `data_registrazione`) VALUES
(1, 'Mario', 'Rossi', 'mario.rossi@example.com', 'hashedpassword1', '2023-10-01'),
(2, 'Luigi', 'Bianchi', 'luigi.bianchi@example.com', 'hashedpassword2', '2023-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `attivita`
--

CREATE TABLE `attivita` (
  `id_attivita` int(11) NOT NULL,
  `nome_attivita` varchar(255) NOT NULL,
  `id_palestra` int(11) DEFAULT NULL,
  `giorno_settimana` enum('Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica') NOT NULL,
  `orario` time NOT NULL,
  `prezzo` decimal(6,2) NOT NULL,
  `posti_disponibili` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attivita`
--

INSERT INTO `attivita` (`id_attivita`, `nome_attivita`, `id_palestra`, `giorno_settimana`, `orario`, `prezzo`, `posti_disponibili`) VALUES
(1, 'Sala macchine', 1, 'Lunedì', '08:00:00', 10.00, 20),
(2, 'Zumba', 2, 'Martedì', '18:00:00', 15.00, 15);

-- --------------------------------------------------------

--
-- Table structure for table `palestre`
--

CREATE TABLE `palestre` (
  `id_palestra` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `latitudine` decimal(10,8) NOT NULL,
  `longitudine` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `palestre`
--

INSERT INTO `palestre` (`id_palestra`, `nome`, `indirizzo`, `citta`, `latitudine`, `longitudine`) VALUES
(1, 'Palestra A', 'Via Roma 1', 'Milano', 45.46420000, 9.19000000),
(2, 'Palestra B', 'Via Torino 2', 'Roma', 41.90280000, 12.49640000);

-- --------------------------------------------------------

--
-- Table structure for table `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id_prenotazione` int(11) NOT NULL,
  `id_abbonato` int(11) DEFAULT NULL,
  `id_attivita` int(11) DEFAULT NULL,
  `data_prenotazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenotazioni`
--

INSERT INTO `prenotazioni` (`id_prenotazione`, `id_abbonato`, `id_attivita`, `data_prenotazione`) VALUES
(1, 1, 1, '2023-10-10'),
(2, 2, 2, '2023-10-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abbonati`
--
ALTER TABLE `abbonati`
  ADD PRIMARY KEY (`id_abbonato`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id_attivita`),
  ADD KEY `id_palestra` (`id_palestra`);

--
-- Indexes for table `palestre`
--
ALTER TABLE `palestre`
  ADD PRIMARY KEY (`id_palestra`);

--
-- Indexes for table `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id_prenotazione`),
  ADD KEY `id_abbonato` (`id_abbonato`),
  ADD KEY `id_attivita` (`id_attivita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abbonati`
--
ALTER TABLE `abbonati`
  MODIFY `id_abbonato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id_attivita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `palestre`
--
ALTER TABLE `palestre`
  MODIFY `id_palestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attivita`
--
ALTER TABLE `attivita`
  ADD CONSTRAINT `attivita_ibfk_1` FOREIGN KEY (`id_palestra`) REFERENCES `palestre` (`id_palestra`);

--
-- Constraints for table `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`id_abbonato`) REFERENCES `abbonati` (`id_abbonato`),
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`id_attivita`) REFERENCES `attivita` (`id_attivita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
