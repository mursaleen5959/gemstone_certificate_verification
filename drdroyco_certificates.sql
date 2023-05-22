-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2023 at 04:57 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drdroyco_certificates`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'gopal', 'admin@gmail.com', 'd47268e9db2e9aa3827bba3afb7ff94a');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `ref_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `origin` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `bead` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `colour` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shape` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `real_faces` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `artificial` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `test` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `margin` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `ref_id`, `img`, `origin`, `bead`, `colour`, `shape`, `size`, `weight`, `real_faces`, `artificial`, `test`, `comment`, `margin`) VALUES
(3, 'REF-08022021090RTC', 'uploads/2.jpg', 'Nepal Stone', '14 Mukhi', 'Dark Brown', 'Round', '21.3*20*18.5 mm', '4.4 Gms', 'Fourteen', 'None', 'X Ray, Magnification', 'Confirmed', '+/- 0.02 mm 0.03%'),
(4, 'REF-RD191267898OHRTC', 'uploads/108.jpg', 'Nepal', '3 mukhi Rudraksha Bead', 'Brown', 'Oval', '22*23*17 mm', '4 Gms', '3 mukhi', 'None', 'Magnification,X Ray', 'Confirmed', '+0.002 mm'),
(6, 'REF-96767290ORTC', 'uploads/6mukhi.jpg', 'Nepal', '18 Mukhi Rudraksha', 'Brown', 'Oval', '22*23*17 mm', '5 Grams', '18', 'None', 'Magnification,X Ray', 'Confirmed', '+0.002 mm'),
(8, 'REF-757687090465', 'uploads/6mukhi2.jpg', 'Nepal', '28 Mukhi Rudraksha Beaded Mala Rosary', 'Brown', 'Oval', '22*23*17 mm', '4 Gms', '28', 'None', 'Magnification,X Ray', 'Confirmed', '+0.002 mm'),
(9, 'REF-5576829077', 'uploads/14m.jpg', 'India', '22 Mukhi Rudraksha', 'Brown', 'Oval', '22*23*17 mm', '4 Gms', '22 Mukhi', 'None', 'Magnification,X Ray', 'Confirmed', '+0.002 mm'),
(10, 'REF-078479479437', 'uploads/13mr2.jpg', 'India', '12 Mukhi', 'Brown', 'Round', '20*21*18 MM', '6 Grams', '12 Faces', 'None', 'Magnification', 'Ok', '+0.003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
