-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 jun 2020 om 14:17
-- Serverversie: 10.1.32-MariaDB
-- PHP-versie: 7.2.5

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
CREATE DATABASE IF NOT EXISTS `innovate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `innovate`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bericht`
--

CREATE TABLE `bericht` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Link` varchar(256) NOT NULL,
  `ShowBericht` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bericht`
--

INSERT INTO `bericht` (`ID`, `UserID`, `Link`, `ShowBericht`) VALUES
(1, 1, 'test', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docent`
--

CREATE TABLE `docent` (
  `ID` int(11) NOT NULL,
  `Voornaam` varchar(256) DEFAULT NULL,
  `Achternaam` varchar(256) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `docent`
--

INSERT INTO `docent` (`ID`, `Voornaam`, `Achternaam`, `Status`, `Foto`) VALUES
(1, 'Jan', 'Doornbos', 1, ''),
(2, 'Elleke', 'Jagersma', 3, ''),
(3, 'Albert', 'de Jonge', 1, ''),
(4, 'Gerjan', 'van Oenen', 1, ''),
(5, 'Rob', 'Smit', 1, ''),
(7, 'Jeroen', 'Pijpker', 3, ''),
(8, 'Winnie', 'van Schilt', 1, ''),
(9, 'Willemijn', 'Meester', 3, ''),
(10, 'Thijs', 'Smegen', 2, ''),
(11, 'Martijn', 'Pomp', 2, ''),
(12, 'Niels', 'Doorn', 1, ''),
(13, 'Rene', 'Laan', 2, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `Token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`ID`, `Token`) VALUES
(5, '068457456598187121950');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(254) NOT NULL,
  `Password` varchar(254) NOT NULL,
  `Statusdisplay` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'TINYINT(boolean) 0 == FALSE boven of onder 0 true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
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
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `docent`
--
ALTER TABLE `docent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `login`
--
ALTER TABLE `login`
  ADD KEY `ID` (`ID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bericht`
--
ALTER TABLE `bericht`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `docent`
--
ALTER TABLE `docent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bericht`
--
ALTER TABLE `bericht`
  ADD CONSTRAINT `bericht_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Beperkingen voor tabel `docent`
--
ALTER TABLE `docent`
  ADD CONSTRAINT `docent_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `user` (`ID`);

--
-- Beperkingen voor tabel `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `docent` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
