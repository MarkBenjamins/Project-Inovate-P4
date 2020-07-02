-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 04:53 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innovate`
--

-- --------------------------------------------------------

--
-- Table structure for table `bericht`
--

CREATE TABLE `bericht` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Link` varchar(256) NOT NULL,
  `ShowBericht` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bericht`
--

INSERT INTO `bericht` (`ID`, `UserID`, `Link`, `ShowBericht`) VALUES
(28, 5, '../img/message/3.png', 1),
(29, 5, '../img/message/4.png', 0),
(30, 5, '../img/message/5.png', 0),
(35, 5, '../img/message/6.png', 0),
(37, 5, '../img/message/7.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `docent`
--

CREATE TABLE `docent` (
  `ID` int(11) NOT NULL,
  `Voornaam` varchar(256) DEFAULT NULL,
  `Achternaam` varchar(256) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docent`
--

INSERT INTO `docent` (`ID`, `Voornaam`, `Achternaam`, `Status`, `Foto`) VALUES
(1, 'Jan', 'Doornbos', 1, ''),
(2, 'Elleke', 'Jagersma', 2, ''),
(3, 'Albert', 'de Jonge', 1, ''),
(4, 'Gerjan', 'van Oenen', 1, ''),
(5, 'Rob', 'Smit', 3, ''),
(7, 'Jeroen', 'Pijpker', 3, ''),
(8, 'Winnie', 'van Schilt', 3, ''),
(9, 'Willemijn', 'Meester', 1, ''),
(10, 'Thijs', 'Smegen', 2, ''),
(11, 'Martijn', 'Pomp', 2, ''),
(12, 'Niels', 'Doorn', 1, ''),
(13, 'Rene', 'Laan', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `Token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `Token`) VALUES
(10, '06906349893737511870'),
(5, '01595170999');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(254) NOT NULL,
  `Password` varchar(254) NOT NULL,
  `Statusdisplay` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'TINYINT(boolean) 0 == FALSE boven of onder 0 true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Statusdisplay`) VALUES
(1, 'Jan', 'Doornbos', 0),
(2, 'Elleke', '123', 0),
(3, 'Albert', 'de Jonge', 0),
(4, 'Gerjan', 'van Oenen', 0),
(5, 'Rob', '1234', 0),
(7, 'Jeroen', '123', 0),
(8, 'Winnie', '123', 0),
(9, 'Willemijn', '123', 0),
(10, 'Thijs', '123', 0),
(11, 'Martijn', '123', 0),
(12, 'Niels', '123', 0),
(13, 'Rene', '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `docent`
--
ALTER TABLE `docent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bericht`
--
ALTER TABLE `bericht`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `docent`
--
ALTER TABLE `docent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bericht`
--
ALTER TABLE `bericht`
  ADD CONSTRAINT `bericht_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `docent`
--
ALTER TABLE `docent`
  ADD CONSTRAINT `docent_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `docent` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
