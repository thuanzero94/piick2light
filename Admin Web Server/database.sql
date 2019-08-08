-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2019 at 09:21 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rack_models`
--

-- --------------------------------------------------------

--
-- Table structure for table `adapters`
--

CREATE TABLE `adapters` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adapters`
--

INSERT INTO `adapters` (`id`, `name`, `description`) VALUES
(1, 'G710-02325-01', ''),
(2, 'G710-02354-01', ''),
(3, 'G710-02353-01', ''),
(4, 'G710-02355-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`) VALUES
(1, 'G953-01307-01', ''),
(2, 'G953-01307-04', ''),
(3, 'G953-01307-06', ''),
(4, 'G953-01307-07', ''),
(5, 'G953-01321-01', ''),
(6, 'G953-01321-04', ''),
(7, 'G953-01321-06', ''),
(8, 'G953-01321-07', ''),
(9, 'G953-01322-01', ''),
(10, 'G953-01322-04', ''),
(11, 'G953-01322-06', ''),
(12, 'G953-01322-07', ''),
(13, 'G953-01323-01', ''),
(14, 'G953-01323-06', ''),
(15, 'G953-01323-07', '');

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `line`
--

INSERT INTO `line` (`id`, `number`, `name`, `description`) VALUES
(1, 'P1', 'Mistral 1PK US', NULL),
(2, 'P2', 'Mistral/Vento 1PK', NULL),
(3, 'P3', '3PK', NULL),
(4, 'P4', '2PK US', NULL),
(5, 'P5', '2PK', '');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_adapter` int(11) DEFAULT NULL,
  `id_document` int(11) DEFAULT NULL,
  `keypart` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `id_adapter`, `id_document`, `keypart`, `description`) VALUES
(1, 'GA00595-US', 1, 1, '0120120005', 'MISTRAL, 1-PK, US'),
(2, 'GA00595-GB', 2, 2, '012012000511', 'MISTRAL, 1-PK, GB'),
(3, 'GA00595-FR', 3, 3, '1 Adapter + 1 Document', 'MISTRAL, 1-PK, FR'),
(4, 'GA00595-AU', 4, 4, '1 Adapter + 1 Document', 'MISTRAL, 1-PK, AU'),
(5, 'G950-02427-EUS', 1, 5, '1 Adapter + 1 Document', 'VENTO, 1-PK, US'),
(6, 'G950-02427-EGB', 2, 6, '1 Adapter + 1 Document', 'VENTO, 1-PK, GB'),
(8, 'G950-02427-EAU', 4, 8, '1 Adapter + 1 Document', 'VENTO, 1-PK, AU'),
(9, 'G950-04210-01', 1, 9, '2 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 2-PK, US'),
(10, 'G950-04211-01', 2, 6, '2 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 2-PK, GB'),
(11, 'G950-04212-01', 3, 11, '2 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 2-PK, FR'),
(12, 'G950-04213-01', 4, 12, '2 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 2-PK, AU'),
(13, 'G950-04214-01', 1, 13, '3 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 3-PK, US'),
(14, 'G950-04215-01', 3, 14, '3 Adapters + 1 Document', 'BUNDLE, MISTRAL, VENTO, 3-PK, FR'),
(15, 'G950-04216-01', 4, 15, '3 Adapters + 1 Documents', 'BUNDLE, MISTRAL, VENTO, 3-PK, AU');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id_line` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `id_rack` int(11) NOT NULL,
  `id_model` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `running` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adapters`
--
ALTER TABLE `adapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kn_mod_doc` (`id_document`),
  ADD KEY `kn_mod_adap` (`id_adapter`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frg_rack_line` (`id_line`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frg_slot_rack` (`id_rack`),
  ADD KEY `frg_slot_model` (`id_model`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adapters`
--
ALTER TABLE `adapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `line`
--
ALTER TABLE `line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `kn_mod_adap` FOREIGN KEY (`id_adapter`) REFERENCES `adapters` (`id`),
  ADD CONSTRAINT `kn_mod_doc` FOREIGN KEY (`id_document`) REFERENCES `documents` (`id`);

--
-- Constraints for table `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `frg_rack_line` FOREIGN KEY (`id_line`) REFERENCES `line` (`id`);

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `frg_slot_model` FOREIGN KEY (`id_model`) REFERENCES `models` (`id`),
  ADD CONSTRAINT `frg_slot_rack` FOREIGN KEY (`id_rack`) REFERENCES `racks` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
