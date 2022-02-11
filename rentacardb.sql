-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2022 at 01:48 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentacardb`
--

-- --------------------------------------------------------

--
-- Table structure for table `automjetet`
--

CREATE TABLE `automjetet` (
  `automjetiid` int(11) NOT NULL,
  `kategoriaid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `nr_regjistrimit` varchar(255) NOT NULL,
  `pershkrimi` text,
  `kostoja` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `automjetet`
--

INSERT INTO `automjetet` (`automjetiid`, `kategoriaid`, `emri`, `nr_regjistrimit`, `pershkrimi`, `kostoja`) VALUES
(5, 8, 'Golf 7', '01-222-VA', '5 seats, Air-condition, A/C, Airbag, Bluetooth, Radio, ABS', '60.00'),
(6, 7, 'BMW 7 series', '01-111-VV', '4 door,front-engine,all-wheel-drive,5-passenger.', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `kategorite`
--

CREATE TABLE `kategorite` (
  `kategoriaid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `pershkrimi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorite`
--

INSERT INTO `kategorite` (`kategoriaid`, `emri`, `pershkrimi`) VALUES
(7, 'Luxury', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. '),
(8, 'Economy', 'Economy cars are smaller vehicles that typically seat up to four passengers. Their high fuel economy makes them great for city driving, while their size makes them easy to maneuver through traffic.');

-- --------------------------------------------------------

--
-- Table structure for table `klientet`
--

CREATE TABLE `klientet` (
  `klientiid` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `mbiemri` varchar(255) NOT NULL,
  `nr_personal` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoni` varchar(255) NOT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roli` bit(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klientet`
--

INSERT INTO `klientet` (`klientiid`, `emri`, `mbiemri`, `nr_personal`, `email`, `telefoni`, `adresa`, `username`, `password`, `roli`) VALUES
(6, 'Valmira', 'Ademi', 1121231234, 'valmira@gmail.com', '045000000', 'Prishtine', 'Valmira', '$2y$10$K5Tz2tqA9x.Zg2gM4/5f0.vqVr9Hgz6oOqAIRUJUwwoWLB8bKNEf6', b'001'),
(8, 'Vanesa', 'Ademi', 1231231234, 'vanesa@gmail.com', '044111222', 'Prishtine', 'Vanesa', '$2y$10$dAEXSL.IG4o4H9fenIUa/u4AWYCVpzrCwMrbAMt/gYxnAN51Wy3FG', b'000'),
(9, 'Valmira', 'Ademi', 11212312345, 'valmiraademii@gmail.com', '0455722641', 'Prishtine', 'Valmire', '$2y$10$lhGRK5OwEHbuu69ZIMrTWecp5Bl2tr6l7V7WABjNvKaIPWxzXOUZ.', b'000');

-- --------------------------------------------------------

--
-- Table structure for table `rezervimet`
--

CREATE TABLE `rezervimet` (
  `rezervimiid` int(11) NOT NULL,
  `klientiid` int(11) NOT NULL,
  `automjetiid` int(11) NOT NULL,
  `data_e_rezervimit` date NOT NULL,
  `data_e_pranimit` date DEFAULT NULL,
  `data_e_kthimit` date DEFAULT NULL,
  `komente` text,
  `statusi` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervimet`
--

INSERT INTO `rezervimet` (`rezervimiid`, `klientiid`, `automjetiid`, `data_e_rezervimit`, `data_e_pranimit`, `data_e_kthimit`, `komente`, `statusi`) VALUES
(3, 8, 5, '2010-02-22', '2022-02-15', '2022-02-17', 'None!', 0),
(5, 8, 6, '2011-02-22', '2022-02-17', '2022-02-20', 'Jo', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automjetet`
--
ALTER TABLE `automjetet`
  ADD PRIMARY KEY (`automjetiid`),
  ADD KEY `kategoriaid` (`kategoriaid`);

--
-- Indexes for table `kategorite`
--
ALTER TABLE `kategorite`
  ADD PRIMARY KEY (`kategoriaid`);

--
-- Indexes for table `klientet`
--
ALTER TABLE `klientet`
  ADD PRIMARY KEY (`klientiid`);

--
-- Indexes for table `rezervimet`
--
ALTER TABLE `rezervimet`
  ADD PRIMARY KEY (`rezervimiid`),
  ADD KEY `klientiid` (`klientiid`),
  ADD KEY `automjetiid` (`automjetiid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automjetet`
--
ALTER TABLE `automjetet`
  MODIFY `automjetiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategorite`
--
ALTER TABLE `kategorite`
  MODIFY `kategoriaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `klientet`
--
ALTER TABLE `klientet`
  MODIFY `klientiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rezervimet`
--
ALTER TABLE `rezervimet`
  MODIFY `rezervimiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automjetet`
--
ALTER TABLE `automjetet`
  ADD CONSTRAINT `automjetet_ibfk_1` FOREIGN KEY (`kategoriaid`) REFERENCES `kategorite` (`kategoriaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervimet`
--
ALTER TABLE `rezervimet`
  ADD CONSTRAINT `rezervimet_ibfk_1` FOREIGN KEY (`klientiid`) REFERENCES `klientet` (`klientiid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rezervimet_ibfk_2` FOREIGN KEY (`automjetiid`) REFERENCES `automjetet` (`automjetiid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
