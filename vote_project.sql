-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 05:11 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vote_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `address` varchar(25) NOT NULL,
  `email` varchar(20) NOT NULL,
  `img` varchar(200) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `C_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `firstName`, `lastName`, `address`, `email`, `img`, `tel`, `C_description`) VALUES
(1, 'foulen', 'fleni', 'sfax', 'aa@aa', 'aaa', '55555555', 'metracha7'),
(2, 'flen 1', 'fouleni 1', 'amdin', 'are@gmail.com', 'aaa', '555555555', 'aaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_election`
--

CREATE TABLE `candidate_election` (
  `id_Candidate` int(11) NOT NULL,
  `id_Election` int(11) NOT NULL,
  `vote_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_election`
--

INSERT INTO `candidate_election` (`id_Candidate`, `id_Election`, `vote_number`) VALUES
(1, 2, 0),
(2, 1, 4),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `nom`, `description`) VALUES
(1, 'Présidentielle ', 'Election Présidentielle'),
(2, 'Parliment', 'Election du Parliment');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `address` varchar(25) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `address`, `email`, `password`, `tel`, `role`) VALUES
(1, 'ahmed', 'rekik', 'sfax', 'arekik6@gmail.com', 'ahmed', '55699881', 0),
(2, 'admin', 'admin', 'amdin', 'admin', 'admin', '55555555', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id_User` int(11) NOT NULL,
  `id_Election` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_election`
--
ALTER TABLE `candidate_election`
  ADD PRIMARY KEY (`id_Candidate`,`id_Election`),
  ADD KEY `Candidate_Election_fk1` (`id_Election`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_User`,`id_Election`),
  ADD KEY `Vote_fk1` (`id_Election`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_election`
--
ALTER TABLE `candidate_election`
  ADD CONSTRAINT `Candidate_Election_fk0` FOREIGN KEY (`id_Candidate`) REFERENCES `candidate` (`id`),
  ADD CONSTRAINT `Candidate_Election_fk1` FOREIGN KEY (`id_Election`) REFERENCES `election` (`id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `Vote_fk0` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `Vote_fk1` FOREIGN KEY (`id_Election`) REFERENCES `election` (`id`);
COMMIT;

ALTER TABLE `candidate_election`
    DROP CONSTRAINT `Candidate_Election_fk0`,
    ADD CONSTRAINT `Candidate_Election_fk0` FOREIGN KEY (`id_Candidate`) REFERENCES `candidate` (`id`) on delete cascade;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
