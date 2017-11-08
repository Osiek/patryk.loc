-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2017 at 02:18 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `added` datetime NOT NULL,
  `manufactured` int(11) NOT NULL,
  `makeid` int(11) NOT NULL,
  `modelid` int(11) NOT NULL,
  `versionid` int(11) NOT NULL,
  `colorid` int(11) NOT NULL,
  `imageid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `title`, `added`, `manufactured`, `makeid`, `modelid`, `versionid`, `colorid`, `imageid`) VALUES
(6, 'Prawie nowy, czarny Ford Fiesta, 2017', '2017-11-08 13:38:14', 2016, 3, 5, 13, 16, 10),
(16, 'Mercedes', '2017-11-08 13:56:09', 1999, 1, 1, 1, 17, 23);

-- --------------------------------------------------------

--
-- Table structure for table `car_equipment`
--

CREATE TABLE `car_equipment` (
  `carid` int(11) NOT NULL,
  `equipmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_equipment`
--

INSERT INTO `car_equipment` (`carid`, `equipmentid`) VALUES
(1, 1),
(1, 2),
(4, 1),
(5, 2),
(5, 1),
(7, 1),
(9, 4),
(9, 7),
(10, 4),
(10, 7),
(14, 4),
(14, 7),
(14, 3),
(14, 1),
(14, 6),
(15, 2),
(15, 6),
(17, 2),
(17, 4),
(17, 5),
(17, 7),
(17, 3),
(17, 1),
(17, 6),
(6, 5),
(6, 6),
(16, 4),
(16, 5),
(16, 3),
(16, 1),
(16, 6);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(15, 'czerwony'),
(16, 'czarny'),
(17, 'niebieski');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`) VALUES
(1, 'Klimatyzacja'),
(2, 'ABS'),
(3, 'Kamera cofania'),
(4, 'Centralny zamek'),
(5, 'Elektryczne lusterka'),
(6, 'Podgrzewane fotele'),
(7, 'Immobilizer');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `path`, `added`) VALUES
(1, 'img1.jpg', '2017-11-06 00:00:00'),
(2, '1510070551_test1.jpg', '2017-11-07 17:02:31'),
(3, '1510071112_test1.jpg', '2017-11-07 17:11:52'),
(4, '1510071127_test1.jpg', '2017-11-07 17:12:07'),
(5, '1510071689_test1.jpg', '2017-11-07 17:21:29'),
(6, '1510071768_test1.jpg', '2017-11-07 17:22:48'),
(7, '1510074750_test1.jpg', '2017-11-07 18:12:30'),
(8, '1510074839_test1.jpg', '2017-11-07 18:13:59'),
(9, '1510075243_test1.jpg', '2017-11-07 18:20:43'),
(10, '1510075329_skoda-fabia.jpeg', '2017-11-07 18:22:09'),
(11, '1510075400_skoda-octavia.jpg', '2017-11-07 18:23:20'),
(12, '1510075426_skoda-octavia.jpg', '2017-11-07 18:23:46'),
(13, '1510130774_skoda-fabia.jpeg', '2017-11-08 09:46:14'),
(14, '1510130896_skoda-fabia.jpeg', '2017-11-08 09:48:16'),
(15, '1510133599_cars.sql', '2017-11-08 10:33:19'),
(16, '1510133996_skoda-octavia.jpg', '2017-11-08 10:39:56'),
(17, '1510134035_skoda-octavia.jpg', '2017-11-08 10:40:35'),
(18, '1510134085_skoda-fabia.jpeg', '2017-11-08 10:41:25'),
(19, '1510134165_skoda-fabia.jpeg', '2017-11-08 10:42:45'),
(20, '1510134241_skoda-fabia.jpeg', '2017-11-08 10:44:01'),
(21, '1510139896_test1.jpg', '2017-11-08 12:18:16'),
(22, '1510141972_test1.jpg', '2017-11-08 12:52:52'),
(23, '1510143997_img1.jpg', '2017-11-08 13:26:37'),
(24, '1510144064_test1.jpg', '2017-11-08 13:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `name`) VALUES
(1, 'Mercedes'),
(2, 'Skoda'),
(3, 'Ford');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `parentid`, `name`) VALUES
(1, 1, 'CL'),
(2, 2, 'Fabia'),
(3, 2, 'Octavia'),
(4, 3, 'Focus'),
(5, 3, 'Fiesta');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `parentid`, `name`) VALUES
(1, 1, 'C216'),
(2, 2, 'I'),
(3, 2, 'II'),
(7, 3, 'I'),
(8, 3, 'II'),
(9, 3, 'III'),
(10, 4, 'Mk1'),
(11, 4, 'Mk2'),
(12, 4, 'Mk3'),
(13, 5, 'Mk6'),
(14, 5, 'Mk7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
