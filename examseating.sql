-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2025 at 10:42 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examseating`
--

-- --------------------------------------------------------

--
-- Table structure for table `invigilatordetails`
--

DROP TABLE IF EXISTS `invigilatordetails`;
CREATE TABLE IF NOT EXISTS `invigilatordetails` (
  `Name` varchar(30) NOT NULL,
  `id` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invigilatordetails`
--

INSERT INTO `invigilatordetails` (`Name`, `id`, `Email`) VALUES
('Shameem', '592', 'riyazayra@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

DROP TABLE IF EXISTS `studentdetails`;
CREATE TABLE IF NOT EXISTS `studentdetails` (
  `Name` varchar(30) NOT NULL,
  `Registerno` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  UNIQUE KEY `Registerno` (`Registerno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`Name`, `Registerno`, `class`, `Email`) VALUES
('KP Ayra Riyaz', 'MEA21CS034', 'S6CSE1', '21gcs22@meaec.edu.in'),
('Hajira Shuhaila', 'MEA21CS026', 'S6CSE1', '21gcs11@meaec.edu.in'),
('Nishana', 'MEA21CS028', 'S6CSE1', 'riyazayra@gmail.com'),
('Hanna', 'MEA21CS027', 'S6CSE1', '21mcs39@meaec.edu.in'),
('Lena Fathima', 'MEA21CS035', 'Lena Fathi', '21gcs22@meaec.edu.in');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
