-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2026 at 06:41 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brandn`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemdetails`
--

DROP TABLE IF EXISTS `itemdetails`;
CREATE TABLE IF NOT EXISTS `itemdetails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemname` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `status` enum('Active','On Hold') NOT NULL,
  `category` enum('Sweets','Spices','Cosmetics','Snacks','Dairy Products','baby care') NOT NULL,
  `stock_location` enum('Lamberet','Mexico','Summit') NOT NULL,
  `expiry_date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `itemdetails`
--

INSERT INTO `itemdetails` (`id`, `itemname`, `price`, `quantity`, `status`, `category`, `stock_location`, `expiry_date`, `description`, `photo`) VALUES
(1, 'Bugles', 50.00, 100, 'Active', 'Snacks', 'Mexico', '2026-10-30', 'Bugles snack pack', 'uploads/photo_6a1db126e5eeb6.99415148.jpeg'),
(2, 'cheetos', 45.00, 500, 'Active', 'Snacks', 'Summit', '2027-01-01', 'cheetos chips ', 'uploads/photo_6a1db154b00187.39502700.jpeg'),
(3, 'Sun Chips', 75.00, 1000, 'Active', 'Snacks', 'Lamberet', '2026-11-11', 'Sun chips ', 'uploads/photo_6a1db18e000fb7.36527485.jpeg'),
(4, 'Cerave', 1500.00, 250, 'Active', 'Cosmetics', 'Summit', '2026-08-12', 'Hydrating Facial Cleanser', 'uploads/photo_6a1db33fed0be1.23234568.jpg'),
(5, 'Irish Spring', 3000.00, 100, 'Active', 'Cosmetics', 'Mexico', '2026-06-12', 'Moisturizing face & body Wash', 'uploads/photo_6a1db46057d346.83569289.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(2, 'staff', '81dc9bdb52d04dc20036dbd8313ed055', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
