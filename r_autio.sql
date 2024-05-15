-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 10:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r.autio`
--

-- --------------------------------------------------------

--
-- Table structure for table `arkisto`
--

CREATE TABLE `arkisto` (
  `arkistoID` int(11) NOT NULL,
  `vikaID` int(11) NOT NULL,
  `kayttajaID` int(11) NOT NULL,
  `prioriteetti` enum('normaali','kiireellinen','kriittinen','') NOT NULL,
  `lisatiedot` varchar(200) NOT NULL,
  `luotu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `toimenpide` varchar(200) NOT NULL,
  `tyontekijaID` int(11) NOT NULL,
  `asunnotID` int(11) NOT NULL,
  `status` enum('valmis') NOT NULL,
  `suoritetaan` datetime DEFAULT NULL,
  `tyontekijan_kommentti` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asunnot_ja_tilat`
--

CREATE TABLE `asunnot_ja_tilat` (
  `asunnotID` int(11) NOT NULL,
  `taloyhtioID` int(11) NOT NULL,
  `asunto/tila` varchar(200) NOT NULL,
  `lisatietoja` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asunnot_ja_tilat`
--

INSERT INTO `asunnot_ja_tilat` (`asunnotID`, `taloyhtioID`, `asunto/tila`, `lisatietoja`) VALUES
(1, 1, 'Asunnot 1-15', '1 rappu'),
(2, 2, 'Asunnot 1-10', '2 rappua'),
(3, 3, '5 asuntoa', 'rivitalo');

-- --------------------------------------------------------

--
-- Table structure for table `hankinnat`
--

CREATE TABLE `hankinnat` (
  `hankintaID` int(11) NOT NULL,
  `vikaID` int(11) NOT NULL,
  `tyontekijaID` int(11) NOT NULL,
  `hankinta` varchar(200) NOT NULL,
  `kuitti` enum('toimitettu toimistoon','ei ole toimitettu','laskutuksella') NOT NULL,
  `hankittu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kayttajat`
--

CREATE TABLE `kayttajat` (
  `kayttajaID` int(11) NOT NULL,
  `etunimi` varchar(50) NOT NULL,
  `sukunimi` varchar(50) NOT NULL,
  `katuosoite` varchar(50) NOT NULL,
  `postinumero` varchar(50) NOT NULL,
  `paikkakunta` varchar(50) NOT NULL,
  `puhelin` varchar(50) NOT NULL,
  `sposti` varchar(50) NOT NULL,
  `rooli` enum('asukas','isannoitsija','tyontekija','toimisto') NOT NULL,
  `salasana` varchar(200) NOT NULL,
  `aktiivinen` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'aktiivinen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kayttajat`
--

INSERT INTO `kayttajat` (`kayttajaID`, `etunimi`, `sukunimi`, `katuosoite`, `postinumero`, `paikkakunta`, `puhelin`, `sposti`, `rooli`, `salasana`, `aktiivinen`) VALUES
(17, 'Ville', 'Vallaton', 'Vallattoman kuja 5 4', '95400', 'Tornio', '123474744', 'ville@vallaton.fi', 'isannoitsija', '$2y$10$/CXLdJYkQF.PU2gobnCc8.eAPm/MeAvgxVdnMhotq0L582gO.wkqO', 1),
(18, 'Hessu', 'Hopo', 'Hessuntie 15 5', '95400', 'Tornio', '3322114411', 'hessu@hopo.fi', 'tyontekija', '$2y$10$8fwX.vx6Zudke9Gl3dkqHO6CkXtbcIKQQtXM16bdUstW0yFIKyOim', 1),
(19, 'Aku', 'Ankka', 'Ankkala 5 11', '95400', 'Tornio', '333111144', 'aku@ankka.fi', 'asukas', '$2y$10$/DEAt8LrwftQmVarrsNaUe0uOt8B17sZyakY49XiJfFYAsKJxhMMu', 1),
(20, 'Hannu', 'Hanhi', 'Hanhikuja 5 11', '95400', 'Tornio', '12345787', 'hannu@hanhi.fi', 'tyontekija', '$2y$10$4UWAWiW/S/R3zZdZnQnvAe8zMT.xmpvWDvbvq3jmXKJhz2dyo5y4u', 1),
(21, 'Teppo', 'Tulppu', 'Tulppukäytävä 22 12', '95400', 'Tornio', '654774411', 'teppo@tulppu.fi', 'asukas', '$2y$10$k33kcsNe79dW3EkumEN5wOToBRLQbBuWyYN.gWK/dNMUcJZ8ItPBC', 1),
(22, 'Iines', 'Ankka', 'Ankkakuja 7 3', '95400', 'Tornio', '325455555', 'iines@ankka.fi', 'toimisto', '$2y$10$hJ2MNTaOgtQV/olWvTVjyeCqRpfYgN2N6WMjpehhcBzIPTN3gEjKu', 1),
(23, 'Bruce', 'Wayne', 'Firmankatu 5 55', '95400', 'Tornio', '654654654', 'bruce@wayne.fi', 'asukas', '$2y$10$Q2bQ5kTT1GxzdbYi8x0IYel2EGV1mj8NmP7Vb/B8orpMTAZFm6AMW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taloyhtiot`
--

CREATE TABLE `taloyhtiot` (
  `taloyhtioID` int(11) NOT NULL,
  `katuosoite` varchar(50) NOT NULL,
  `postinumero` varchar(50) NOT NULL,
  `paikkakunta` varchar(50) NOT NULL,
  `nimi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taloyhtiot`
--

INSERT INTO `taloyhtiot` (`taloyhtioID`, `katuosoite`, `postinumero`, `paikkakunta`, `nimi`) VALUES
(1, 'Kulleronkuja 1', '95400', 'Tornio', 'Kulleronkujan yhtiö OY'),
(2, 'Jääkärinkatu 40-50', '95400', 'Tornio', 'Jääkärin asunnot OY'),
(3, 'Särkinäräntie 10', '95400', 'Tornio', 'Särkkärin asunnot OY'),
(4, 'Vallattoman kuja 5', '95400', 'Tornio', 'Vallattoman kujan asunnot OY'),
(5, 'Hessuntie 15', '95400', 'Tornio', 'Hopon kämpät OY'),
(6, 'Ankkala 5', '95400', 'Tornio', 'Akun asunnot OY'),
(7, 'Hanhikuja 5', '95400', 'Tornio', 'Hannulan asunnot OY'),
(8, 'Tulppukäytävä 22', '95400', 'Tornio', 'Tepon kämpät OY'),
(9, 'Ankkakuja 7', '95400', 'Tornio', 'Akun vara-asunnot OY'),
(10, 'Firmankatu 5', '95400', 'Tornio', 'Wayne lukaalit OY');

-- --------------------------------------------------------

--
-- Table structure for table `tyontekijat`
--

CREATE TABLE `tyontekijat` (
  `tyontekijaID` int(11) NOT NULL,
  `etunimi` varchar(50) NOT NULL,
  `sukunimi` varchar(50) NOT NULL,
  `tila` enum('vapaa','varattu','ei saatavilla') NOT NULL,
  `kayttajaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tyontekijat`
--

INSERT INTO `tyontekijat` (`tyontekijaID`, `etunimi`, `sukunimi`, `tila`, `kayttajaID`) VALUES
(8, 'Hessu', 'Hopo', 'vapaa', 18),
(9, 'Aku', 'Ankka', 'vapaa', 19);

-- --------------------------------------------------------

--
-- Table structure for table `vikailmotukset`
--

CREATE TABLE `vikailmotukset` (
  `vikaID` int(11) NOT NULL,
  `lisatiedot` varchar(500) NOT NULL,
  `prioriteetti` enum('normaali','kiireellinen','kriittinen') NOT NULL,
  `kayttajaID` int(11) NOT NULL,
  `luotu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `toimenpide` varchar(200) DEFAULT NULL,
  `tyontekijaID` int(11) DEFAULT NULL,
  `asunnotID` int(11) DEFAULT NULL,
  `status` enum('avoin','tyon alla') NOT NULL,
  `suoritetaan` datetime DEFAULT NULL,
  `tyontekijan_kommentti` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vikailmotukset`
--

INSERT INTO `vikailmotukset` (`vikaID`, `lisatiedot`, `prioriteetti`, `kayttajaID`, `luotu`, `toimenpide`, `tyontekijaID`, `asunnotID`, `status`, `suoritetaan`, `tyontekijan_kommentti`) VALUES
(159, 'Teppo vaatii nyt huoltomiestä käymään.', 'normaali', 21, '2024-05-15 20:21:51', NULL, NULL, NULL, 'avoin', NULL, NULL),
(160, 'Vaatii huoltomiestä käymään nopeampaa', 'kiireellinen', 21, '2024-05-15 20:22:19', NULL, NULL, NULL, 'avoin', NULL, NULL),
(161, 'Akulla on hätä koska syyt', 'kriittinen', 19, '2024-05-15 20:23:13', NULL, NULL, NULL, 'avoin', NULL, NULL),
(162, 'Ja ehkäpä on vielä toinenkin hätä ihan varmuuden vuoksi', 'normaali', 19, '2024-05-15 20:23:24', NULL, NULL, NULL, 'avoin', NULL, NULL),
(163, 'Hanat vuotaa lepakkoluolassa', 'normaali', 23, '2024-05-15 20:24:00', NULL, NULL, NULL, 'avoin', NULL, NULL),
(164, 'Ovi ei sulkeudu kunnolla lepakkoluolaan', 'kriittinen', 23, '2024-05-15 20:24:09', NULL, NULL, NULL, 'avoin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yhteydenotto`
--

CREATE TABLE `yhteydenotto` (
  `yhteydenottoID` int(11) NOT NULL,
  `nimi` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `viesti` varchar(500) NOT NULL,
  `luotu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yhteydenotto`
--

INSERT INTO `yhteydenotto` (`yhteydenottoID`, `nimi`, `email`, `viesti`, `luotu`) VALUES
(1, 'Ville', 'Vallaton@vallattoman.fi', 'testataan', '2024-05-03 14:20:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arkisto`
--
ALTER TABLE `arkisto`
  ADD PRIMARY KEY (`arkistoID`);

--
-- Indexes for table `asunnot_ja_tilat`
--
ALTER TABLE `asunnot_ja_tilat`
  ADD PRIMARY KEY (`asunnotID`),
  ADD KEY `taloyhtioID` (`taloyhtioID`);

--
-- Indexes for table `hankinnat`
--
ALTER TABLE `hankinnat`
  ADD PRIMARY KEY (`hankintaID`),
  ADD KEY `vikaID` (`vikaID`,`tyontekijaID`),
  ADD KEY `tyontekijaID` (`tyontekijaID`);

--
-- Indexes for table `kayttajat`
--
ALTER TABLE `kayttajat`
  ADD PRIMARY KEY (`kayttajaID`);

--
-- Indexes for table `taloyhtiot`
--
ALTER TABLE `taloyhtiot`
  ADD PRIMARY KEY (`taloyhtioID`);

--
-- Indexes for table `tyontekijat`
--
ALTER TABLE `tyontekijat`
  ADD PRIMARY KEY (`tyontekijaID`),
  ADD KEY `kayttajaID` (`kayttajaID`);

--
-- Indexes for table `vikailmotukset`
--
ALTER TABLE `vikailmotukset`
  ADD PRIMARY KEY (`vikaID`),
  ADD KEY `kayttajaID` (`kayttajaID`,`tyontekijaID`,`asunnotID`),
  ADD KEY `asunnotID` (`asunnotID`),
  ADD KEY `tyontekijaID` (`tyontekijaID`);

--
-- Indexes for table `yhteydenotto`
--
ALTER TABLE `yhteydenotto`
  ADD PRIMARY KEY (`yhteydenottoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arkisto`
--
ALTER TABLE `arkisto`
  MODIFY `arkistoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `asunnot_ja_tilat`
--
ALTER TABLE `asunnot_ja_tilat`
  MODIFY `asunnotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hankinnat`
--
ALTER TABLE `hankinnat`
  MODIFY `hankintaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kayttajat`
--
ALTER TABLE `kayttajat`
  MODIFY `kayttajaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `taloyhtiot`
--
ALTER TABLE `taloyhtiot`
  MODIFY `taloyhtioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tyontekijat`
--
ALTER TABLE `tyontekijat`
  MODIFY `tyontekijaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vikailmotukset`
--
ALTER TABLE `vikailmotukset`
  MODIFY `vikaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `yhteydenotto`
--
ALTER TABLE `yhteydenotto`
  MODIFY `yhteydenottoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asunnot_ja_tilat`
--
ALTER TABLE `asunnot_ja_tilat`
  ADD CONSTRAINT `asunnot_ja_tilat_ibfk_1` FOREIGN KEY (`taloyhtioID`) REFERENCES `taloyhtiot` (`taloyhtioID`);

--
-- Constraints for table `hankinnat`
--
ALTER TABLE `hankinnat`
  ADD CONSTRAINT `hankinnat_ibfk_1` FOREIGN KEY (`tyontekijaID`) REFERENCES `tyontekijat` (`tyontekijaID`),
  ADD CONSTRAINT `hankinnat_ibfk_2` FOREIGN KEY (`vikaID`) REFERENCES `vikailmotukset` (`vikaID`);

--
-- Constraints for table `tyontekijat`
--
ALTER TABLE `tyontekijat`
  ADD CONSTRAINT `tyontekijat_ibfk_1` FOREIGN KEY (`kayttajaID`) REFERENCES `kayttajat` (`kayttajaID`);

--
-- Constraints for table `vikailmotukset`
--
ALTER TABLE `vikailmotukset`
  ADD CONSTRAINT `vikailmotukset_ibfk_2` FOREIGN KEY (`kayttajaID`) REFERENCES `kayttajat` (`kayttajaID`),
  ADD CONSTRAINT `vikailmotukset_ibfk_3` FOREIGN KEY (`asunnotID`) REFERENCES `asunnot_ja_tilat` (`asunnotID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
