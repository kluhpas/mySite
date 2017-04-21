-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 05:59 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `allievo`
--

CREATE TABLE `allievo` (
  `idAllievo` int(11) NOT NULL,
  `codiceTesseramento` int(11) DEFAULT NULL COMMENT 'Codice Tesseramento FIS',
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(100) NOT NULL,
  `codiceFiscale` varchar(16) NOT NULL,
  `sesso` tinyint(1) NOT NULL,
  `via` varchar(255) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `agonista` tinyint(1) NOT NULL,
  `urlFoto` varchar(255) NOT NULL,
  `scadenzaCertMedico` date DEFAULT NULL,
  `idSocieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allievo-arma`
--

CREATE TABLE `allievo-arma` (
  `idAllievo` int(11) NOT NULL,
  `idArma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allievo-categoria`
--

CREATE TABLE `allievo-categoria` (
  `idAllievo` int(11) NOT NULL,
  `idCategoria` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allievo-parente`
--

CREATE TABLE `allievo-parente` (
  `idAllievo` int(11) NOT NULL,
  `idParente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allievo-quota-rata`
--

CREATE TABLE `allievo-quota-rata` (
  `idAllievo` int(11) NOT NULL,
  `idQuota` int(11) NOT NULL,
  `idRata` int(11) NOT NULL,
  `dataSaldo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arma`
--

CREATE TABLE `arma` (
  `idArma` varchar(20) NOT NULL COMMENT 'Nome Arma'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` varchar(70) NOT NULL,
  `tipoLama` int(11) NOT NULL,
  `lunghezzaLama` float NOT NULL,
  `diametroCoccia` float NOT NULL,
  `resistenzaDivisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categoria-corso`
--

CREATE TABLE `categoria-corso` (
  `idCategoria` varchar(70) NOT NULL,
  `idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `idCorso` int(11) NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `corso-sede`
--

CREATE TABLE `corso-sede` (
  `idCorso` int(11) NOT NULL,
  `idSede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `giorno`
--

CREATE TABLE `giorno` (
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lezione`
--

CREATE TABLE `lezione` (
  `idLezione` int(11) NOT NULL,
  `appunti` text,
  `idAllievo` int(11) DEFAULT NULL,
  `idMaestro` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maestro`
--

CREATE TABLE `maestro` (
  `idMaestro` int(11) NOT NULL,
  `codiceTesseramento` int(11) NOT NULL COMMENT 'Codice tesseramento FIS',
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(100) NOT NULL,
  `codiceFiscale` varchar(16) NOT NULL,
  `sesso` tinyint(1) NOT NULL,
  `via` varchar(255) NOT NULL,
  `CAP` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `urlFoto` varchar(255) NOT NULL,
  `scadenzaCertMedico` date NOT NULL,
  `idSocieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maestro-arma`
--

CREATE TABLE `maestro-arma` (
  `idMaestro` int(11) NOT NULL,
  `idArma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maestro-giorno`
--

CREATE TABLE `maestro-giorno` (
  `idMaestro` int(11) NOT NULL,
  `data` date NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parente`
--

CREATE TABLE `parente` (
  `idParente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `parentela` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quota-rata`
--

CREATE TABLE `quota-rata` (
  `idQuota` int(11) NOT NULL,
  `idRata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotasociale`
--

CREATE TABLE `quotasociale` (
  `idQuota` int(11) NOT NULL,
  `nomeQuota` varchar(255) NOT NULL,
  `idSocieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rata`
--

CREATE TABLE `rata` (
  `idRata` int(11) NOT NULL,
  `numeroRata` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `dataScadenza` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sede`
--

CREATE TABLE `sede` (
  `idSede` int(11) NOT NULL,
  `via` varchar(255) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `idSocieta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sede-giorno`
--

CREATE TABLE `sede-giorno` (
  `idSede` int(11) NOT NULL,
  `data` date NOT NULL,
  `oraApertura` time NOT NULL,
  `oraChiusura` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `societa`
--

CREATE TABLE `societa` (
  `idSocieta` int(11) NOT NULL,
  `codiceSocieta` varchar(20) NOT NULL COMMENT '(BGPOL)',
  `nome` varchar(255) NOT NULL COMMENT '(Scherma Bergamo)',
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allievo`
--
ALTER TABLE `allievo`
  ADD PRIMARY KEY (`idAllievo`),
  ADD UNIQUE KEY `codiceTesseramento` (`codiceTesseramento`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idSocieta` (`idSocieta`);

--
-- Indexes for table `allievo-arma`
--
ALTER TABLE `allievo-arma`
  ADD PRIMARY KEY (`idAllievo`,`idArma`),
  ADD KEY `idArma` (`idArma`);

--
-- Indexes for table `allievo-categoria`
--
ALTER TABLE `allievo-categoria`
  ADD PRIMARY KEY (`idAllievo`,`idCategoria`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indexes for table `allievo-parente`
--
ALTER TABLE `allievo-parente`
  ADD PRIMARY KEY (`idAllievo`,`idParente`),
  ADD KEY `idParente` (`idParente`),
  ADD KEY `idAllievo` (`idAllievo`);

--
-- Indexes for table `allievo-quota-rata`
--
ALTER TABLE `allievo-quota-rata`
  ADD PRIMARY KEY (`idAllievo`,`idQuota`,`idRata`),
  ADD KEY `idQuota` (`idQuota`),
  ADD KEY `idRata` (`idRata`);

--
-- Indexes for table `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`idArma`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `categoria-corso`
--
ALTER TABLE `categoria-corso`
  ADD PRIMARY KEY (`idCategoria`,`idCorso`),
  ADD KEY `idCorso` (`idCorso`);

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`idCorso`);

--
-- Indexes for table `corso-sede`
--
ALTER TABLE `corso-sede`
  ADD PRIMARY KEY (`idCorso`,`idSede`),
  ADD KEY `idSede` (`idSede`);

--
-- Indexes for table `giorno`
--
ALTER TABLE `giorno`
  ADD PRIMARY KEY (`data`);

--
-- Indexes for table `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`idLezione`),
  ADD KEY `idAllievo` (`idAllievo`),
  ADD KEY `idMaestro` (`idMaestro`),
  ADD KEY `data` (`data`),
  ADD KEY `data_2` (`data`);

--
-- Indexes for table `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`idMaestro`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `codiceTesseramento` (`codiceTesseramento`),
  ADD KEY `idSocieta` (`idSocieta`);

--
-- Indexes for table `maestro-arma`
--
ALTER TABLE `maestro-arma`
  ADD PRIMARY KEY (`idMaestro`,`idArma`),
  ADD KEY `idArma` (`idArma`);

--
-- Indexes for table `maestro-giorno`
--
ALTER TABLE `maestro-giorno`
  ADD PRIMARY KEY (`idMaestro`,`data`),
  ADD KEY `data` (`data`);

--
-- Indexes for table `parente`
--
ALTER TABLE `parente`
  ADD PRIMARY KEY (`idParente`);

--
-- Indexes for table `quota-rata`
--
ALTER TABLE `quota-rata`
  ADD PRIMARY KEY (`idQuota`,`idRata`),
  ADD KEY `idRata` (`idRata`);

--
-- Indexes for table `quotasociale`
--
ALTER TABLE `quotasociale`
  ADD PRIMARY KEY (`idQuota`),
  ADD KEY `idSocieta` (`idSocieta`);

--
-- Indexes for table `rata`
--
ALTER TABLE `rata`
  ADD PRIMARY KEY (`idRata`);

--
-- Indexes for table `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`idSede`),
  ADD KEY `idSocieta` (`idSocieta`);

--
-- Indexes for table `sede-giorno`
--
ALTER TABLE `sede-giorno`
  ADD PRIMARY KEY (`idSede`,`data`),
  ADD KEY `data` (`data`);

--
-- Indexes for table `societa`
--
ALTER TABLE `societa`
  ADD PRIMARY KEY (`idSocieta`),
  ADD UNIQUE KEY `codiceSocieta` (`codiceSocieta`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allievo`
--
ALTER TABLE `allievo`
  MODIFY `idAllievo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `corso`
--
ALTER TABLE `corso`
  MODIFY `idCorso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lezione`
--
ALTER TABLE `lezione`
  MODIFY `idLezione` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maestro`
--
ALTER TABLE `maestro`
  MODIFY `idMaestro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parente`
--
ALTER TABLE `parente`
  MODIFY `idParente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sede`
--
ALTER TABLE `sede`
  MODIFY `idSede` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `societa`
--
ALTER TABLE `societa`
  MODIFY `idSocieta` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `allievo`
--
ALTER TABLE `allievo`
  ADD CONSTRAINT `allievo_ibfk_1` FOREIGN KEY (`idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `allievo-arma`
--
ALTER TABLE `allievo-arma`
  ADD CONSTRAINT `allievo-arma_ibfk_1` FOREIGN KEY (`idAllievo`) REFERENCES `allievo` (`idAllievo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allievo-arma_ibfk_2` FOREIGN KEY (`idArma`) REFERENCES `arma` (`idArma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `allievo-categoria`
--
ALTER TABLE `allievo-categoria`
  ADD CONSTRAINT `allievo-categoria_ibfk_1` FOREIGN KEY (`idAllievo`) REFERENCES `allievo` (`idAllievo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allievo-categoria_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `allievo-parente`
--
ALTER TABLE `allievo-parente`
  ADD CONSTRAINT `allievo-parente_ibfk_2` FOREIGN KEY (`idAllievo`) REFERENCES `allievo` (`idAllievo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allievo-parente_ibfk_3` FOREIGN KEY (`idParente`) REFERENCES `parente` (`idParente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `allievo-quota-rata`
--
ALTER TABLE `allievo-quota-rata`
  ADD CONSTRAINT `allievo-quota-rata_ibfk_1` FOREIGN KEY (`idAllievo`) REFERENCES `allievo` (`idAllievo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allievo-quota-rata_ibfk_2` FOREIGN KEY (`idQuota`) REFERENCES `quotasociale` (`idQuota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allievo-quota-rata_ibfk_3` FOREIGN KEY (`idRata`) REFERENCES `rata` (`idRata`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categoria-corso`
--
ALTER TABLE `categoria-corso`
  ADD CONSTRAINT `categoria-corso_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categoria-corso_ibfk_2` FOREIGN KEY (`idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `corso-sede`
--
ALTER TABLE `corso-sede`
  ADD CONSTRAINT `corso-sede_ibfk_1` FOREIGN KEY (`idSede`) REFERENCES `sede` (`idSede`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `corso-sede_ibfk_2` FOREIGN KEY (`idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `lezione_ibfk_1` FOREIGN KEY (`idAllievo`) REFERENCES `allievo` (`idAllievo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lezione_ibfk_2` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lezione_ibfk_3` FOREIGN KEY (`data`) REFERENCES `giorno` (`data`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `maestro_ibfk_1` FOREIGN KEY (`idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `maestro-arma`
--
ALTER TABLE `maestro-arma`
  ADD CONSTRAINT `maestro-arma_ibfk_1` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maestro-arma_ibfk_2` FOREIGN KEY (`idArma`) REFERENCES `arma` (`idArma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maestro-giorno`
--
ALTER TABLE `maestro-giorno`
  ADD CONSTRAINT `maestro-giorno_ibfk_1` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maestro-giorno_ibfk_2` FOREIGN KEY (`data`) REFERENCES `giorno` (`data`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quota-rata`
--
ALTER TABLE `quota-rata`
  ADD CONSTRAINT `quota-rata_ibfk_1` FOREIGN KEY (`idQuota`) REFERENCES `quotasociale` (`idQuota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quota-rata_ibfk_2` FOREIGN KEY (`idRata`) REFERENCES `rata` (`idRata`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotasociale`
--
ALTER TABLE `quotasociale`
  ADD CONSTRAINT `quotasociale_ibfk_1` FOREIGN KEY (`idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `sede_ibfk_1` FOREIGN KEY (`idSocieta`) REFERENCES `societa` (`idSocieta`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sede_ibfk_2` FOREIGN KEY (`idSede`) REFERENCES `sede-giorno` (`idSede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sede-giorno`
--
ALTER TABLE `sede-giorno`
  ADD CONSTRAINT `sede-giorno_ibfk_1` FOREIGN KEY (`data`) REFERENCES `giorno` (`data`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
