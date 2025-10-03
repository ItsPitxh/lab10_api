-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2025 at 12:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab10_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `CarID` int(11) NOT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`CarID`, `Brand`, `Model`, `Year`, `Price`, `Mileage`, `Status`) VALUES
(2, 'Toyota', 'Camry', 2023, 28500.00, 5000, 'Used'),
(3, 'Honda', 'Civic', 2024, 24000.00, 0, 'New'),
(4, 'Honda', 'Accord', 2021, 26000.00, 32000, 'Used'),
(5, 'Ford', 'Mustang', 2022, 38000.00, 12000, 'Used'),
(6, 'Ford', 'F-150', 2023, 42500.00, 7000, 'Used'),
(7, 'Chevrolet', 'Malibu', 2020, 19500.00, 45000, 'Used'),
(8, 'Chevrolet', 'Silverado', 2024, 48000.00, 0, 'New'),
(9, 'Nissan', 'Altima', 2022, 22000.00, 18000, 'Used'),
(10, 'Nissan', 'Rogue', 2023, 27000.00, 6000, 'Used'),
(11, 'BMW', '3 Series', 2021, 34500.00, 29000, 'Used'),
(12, 'BMW', 'X5', 2024, 62000.00, 0, 'New'),
(13, 'Mercedes', 'C-Class', 2023, 41500.00, 4000, 'Used'),
(14, 'Mercedes', 'GLE', 2024, 71000.00, 0, 'New'),
(15, 'Audi', 'A4', 2022, 36000.00, 10000, 'Used'),
(16, 'Audi', 'Q7', 2023, 68500.00, 3500, 'Used'),
(17, 'Hyundai', 'Elantra', 2024, 21500.00, 0, 'New'),
(18, 'Hyundai', 'Tucson', 2021, 24000.00, 40000, 'Used'),
(19, 'Kia', 'Sportage', 2022, 25500.00, 16000, 'Used'),
(20, 'Tesla', 'Model 3', 2024, 39900.00, 0, 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`CarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
